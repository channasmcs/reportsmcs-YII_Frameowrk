<?php

class ReportController extends Controller
{
	public function actionIndex()
	{  
          
		$this->render('index');
	}
        
	public function actionGetreport()
	{  
           if(isset($_POST))
           {

                  $models=  $_POST['report']['table_name']::model()->findAll();
                    // Pick a filename and destination directory for the file  by channa
                    // Remember that the folder where you want to write the file has to be writable  by channa

                     $filename =Yii::getPathOfAlias('webroot').'/assets/report_smcs_'.$_POST['report']['table_name'].'.csv';
              
                    // Actually create the file  by channa
                    // The w+ parameter will wipe out and overwrite any existing file with the same name  by channa

                    //   get data tabel field by channa
      
                     $getfield= $_POST['report']['table_name']::model()->getTableSchema()->getColumnNames();
                   
                    $handle = fopen($filename, 'w+');
                     fputcsv($handle,$getfield);
          
                 foreach($models as $row)
                        {         

                              fputcsv($handle,$row->attributes);
                        }

                        // Finish writing the file 
                       fclose($handle);             
                    
		$this->redirect(Yii::app()->getBaseUrl(true).'/assets/report_smcs_'.$_POST['report']['table_name'].'.csv', array('target'=>'_blank'));
                Yii::app()->user->setFlash('report_message','
                           <div class="review_sms_message">
                                    <div style="width:500px;float:left;display:inline-block;">
                                        <b style="text-transform: uppercase;">Your report successfully generated</b>

                                        <p class="review_sms_message_p">
                                            click Download button to download report
                                          </p>
                                    </div>
                                    <div style="margin-left:100px;">
                                        <a class="review_sms_message_button" href="'.$filename.'">Download Report</a>
                                    </div>
                            </div> 
                                                 ');			
           }
		$this->redirect(array('index'));
	}
	
        
       
      
}
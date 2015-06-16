<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);

?>
<?php $this->renderPartial('style'); ?>
<?php
 
//get all data table 
     $model_name= str_replace(".php", "", glob('./protected/models/*.php'));
     $model_names= str_replace("./protected/models/", "", $model_name);
     $list_model=  array_combine($model_names,$model_names);
 

?>


<?php 
//check YII urlManager
    if(Yii::app()->request->url =='/auto_copmplte/index.php?r=report_smcs/report')
        {
        $form=$this->beginWidget('CActiveForm', array(
	'id'=>'report-form',
         'action'=>Yii::app()->baseUrl.'/index.php?r=report_smcs/report/getreport',
	'enableAjaxValidation'=>false,
            ));
      }
   elseif (Yii::app()->request->url =='/auto_copmplte/index.php/report_smcs/report/') 
        {
        $form=$this->beginWidget('CActiveForm', array(
	'id'=>'report-form',
         'action'=>Yii::app()->baseUrl.'/index.php/report_smcs/report/getreport',
	'enableAjaxValidation'=>false,
        ));
       }


?>

<div class="review_sms_form">
    <h1>MY Report</h1>
    <div class="review_sms_content">
        
            <?php echo CHtml::dropDownList('report[table_name]','',  
                        $list_model ,
                    array('empty' => 'Select data table'),
                    array('style' => 'width: 40%')
                    
              );?>
        
     </div>  
      <div class="review_sms_content">
            <?php echo CHtml::submitButton("Genarate Report", array('id'=>'btSubmit','class' => 'btn', 'name' => 'files', 'title' => 'Save the updates to these files')); ?>
    
      </div> 
           <br/>    
           
             <?php echo Yii::app()->user->getFlash('report_message'); ?>
</div>
<?php $this->endWidget(); ?>




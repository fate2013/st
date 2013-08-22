<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'new-act-form',
	'enableClientValidation'=>true,
    'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


<div class="row">
    <?php echo $form->labelEx($model,'subject'); ?>
    <?php echo $form->textField($model,'subject'); ?>
    <?php echo $form->error($model,'subject'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'profile'); ?>
    <?php echo $form->textArea($model,'profile',array('rows'=>10,'cols'=>60)); ?>
    <?php echo $form->error($model,'profile'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'start_time'); ?>
    <?php echo $form->textField($model,'start_time', array('readonly'=>true)); ?>
    <?php echo $form->error($model,'start_time'); ?>
</div>
<div class="row buttons">
    <?php echo CHtml::submitButton('创建'); ?>
</div>
<?php $this->endWidget(); ?>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.custom.min.css" />
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.custom.min.js'></script>
<script>
$("#Activity_start_time").datepicker({
    dateFormat: "yy-mm-dd",
    appendText: "(yyyy-mm-dd)"
});
</script>

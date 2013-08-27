<style>
.left_content{display:none;}
.content{margin: 0 auto;float:none;overflow: visible;}
.content_bar{-webkit-border-top-left-radius: 6px;-moz-top-left-border-radius: 6px;border-top-left-radius: 6px;}
</style>
<div class="wide form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'new-act-form',
	'enableClientValidation'=>true,
    'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


<div class="row2">
    <?php echo $form->labelEx($model,'subject'); ?>
    <?php echo $form->textField($model,'subject'); ?>
    <?php echo $form->error($model,'subject'); ?>
</div>
<div class="row2">
    <?php echo $form->labelEx($model,'type'); ?>
    <?php echo $form->dropDownList($model,'type',ActTypeList::$list); ?>
    <?php echo $form->error($model,'type'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'start_time'); ?>
    <?php echo $form->textField($model,'start_time', array('readonly'=>true)); ?>
    <?php echo $form->error($model,'start_time'); ?>
</div>
<div class="row editor">
    <?php echo $form->labelEx($model,'profile'); ?>
    <?php echo $form->textArea($model,'profile',array('rows'=>10,'cols'=>60)); ?>
    <?php echo $form->error($model,'profile'); ?>
</div>
<div class="row buttons">
    <?php echo CHtml::submitButton('创建'); ?>
    <?php echo CHtml::Button('取消', array('onclick' => 'javascript:history.go(-1);')); ?>
</div>
<?php $this->endWidget(); ?>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.custom.min.css" />
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.custom.min.js'></script>
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-timepicker-addon.min.js'></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/ckeditor/adapters/jquery.js"></script>
<script>
$("#Activity_start_time").datetimepicker({
    dateFormat: "yy-mm-dd"
});
$('#Activity_profile').ckeditor({
    height:'400px',
    filebrowserImageUploadUrl: '/site/upload',
    filebrowserBrowseUrl: '/site/browse'
});
</script>

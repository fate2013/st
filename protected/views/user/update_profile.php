<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1><?php echo $user->displayName(); ?> 个人资料</h1>

<p>请填写你的个人资料:</p>

<div class="wide form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->radioButtonList($model,'sex', UserProfile::model()->genderSelection(), array('separator'=>'&nbsp','labelOptions'=>array('class'=>'labelForRadio'))); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('提交'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.custom.min.css" />
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.custom.min.js'></script>
<script>
var year = new Date().getFullYear();
$("#UserProfile_birthday").datepicker({
    dateFormat: "yy-mm-dd",
    changeYear: true,
    changeMonth: true,
    yearRange: "1950:"+year
});
</script>

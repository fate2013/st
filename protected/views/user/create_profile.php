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

<div class="form">
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
		<?php echo $form->labelEx($model,'age'); ?>
		<?php echo $form->textField($model,'age'); ?>
		<?php echo $form->error($model,'age'); ?>
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
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

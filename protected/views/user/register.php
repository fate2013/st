<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Register',
);
?>

<h1>Register</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
    'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<div class="row">
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textField($model,'name'); ?>
    <?php echo $form->error($model,'name'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password'); ?>
    <?php echo $form->error($model,'password'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'password2'); ?>
    <?php echo $form->passwordField($model,'password2'); ?>
    <?php echo $form->error($model,'password2'); ?>
</div>

<?php if(CCaptcha::checkRequirements()): ?>
<div class="row">
    <?php echo $form->labelEx($model,'verifyCode'); ?>
    <div>
    <?php $this->widget('CCaptcha'); ?>
    <br />
    <?php echo $form->textField($model,'verifyCode'); ?>
    </div>
    <div class="hint">Please enter the letters as they are shown in the image above.
    <br/>Letters are not case-sensitive.</div>
    <?php echo $form->error($model,'verifyCode'); ?>
</div>
<?php endif; ?>


<div class="row buttons">
    <?php echo CHtml::submitButton('Login'); ?>
</div>

<?php $this->endWidget(); ?>
</div>

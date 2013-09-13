<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

    <script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js'></script>
    <script src='<?php echo Yii::app()->request->baseUrl; ?>/js/index.js'></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="topbar">
    <div class="header_wrap">
        <div class="welcome_bar">Welcome to <span class="app_name"><?php echo CHtml::encode(Yii::app()->name); ?></span></div>
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        )); ?>
        </div>
    </div>
<div id="header">
    <div class="header_wrap">
        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
    </div>
</div><!-- header -->

<div class="container" id="page">
	<!--
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>
    -->
<?php
$this->pageTitle=Yii::app()->name;
?>

<div class="main">

<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Register',
);
?>
<div class="formout">
<div class="formwrap">

<?php
$this->pageTitle=Yii::app()->name . ' - Register';
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
</div>
</div>
</div>

	<div class="clear"></div>


</div><!-- page -->

<div id="footer">
    Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
    All Rights Reserved.<br/>
    <?php echo Myii::powered(); ?>
</div><!-- footer -->

</body>
</html>

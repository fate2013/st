<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />

    <script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js'></script>
    <script src='<?php echo Yii::app()->request->baseUrl; ?>/js/login.js'></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php
$this->pageTitle=Yii::app()->name;
?>

<div class='topbar'>
    <div class='topcontent'>
        <div class='logo'>
        </div>       
        <div class='input'>
            <img src='/images/search.png' />
            <input type='text' />
        </div>
        <div class='nav'>
            <ul>
                <li>首页
                <li>活动
                <li>站点
                <li>联系我们
            </ul>
        </div>
    </div>
</div>

<div class="main">
    <div class='banner'>
        <img src='/images/banner.png' />
        <div>
            分享让生活更精彩！
        </div>
    </div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <div class='login'>
        <div class='logintop'>
        </div>
        <div class='loginframe'>
            <div class='name_pic'></div>
            <div class='pass_pic'></div>
            <div class="row">
                <?php echo $form->textField($model,'username', array('tabindex'=>1, 'autofocus'=>true, 'class'=>'input_text', 'placeholder'=>'用户名', 'autocomplete'=>'off', 'required'=>true)); ?>
            </div>
            <div class="row">
                <?php echo $form->passwordField($model,'password', array('tabindex'=>2, 'class'=>'input_text', 'placeholder'=>'密码', 'autocomplete'=>'off', 'required'=>true)); ?>
            </div>

            <?php if(CCaptcha::checkRequirements()): ?>
            <div class="row">
                <div>
                <?php echo $form->textField($model,'verifyCode', array('tabindex'=>3, 'class'=>'input_text captcha', 'autocomplete'=>'off', 'placeholder'=>'请输入验证码', 'required'=>true)); ?>
                <?php $this->widget('CCaptcha'); ?>
                </div>
            </div>
            <?php endif; ?>

            <div class='logintool'>
                <?php echo $form->error($model,'username'); ?>
                <?php echo $form->error($model,'password'); ?>
                <?php echo $form->error($model,'verifyCode'); ?>
                <input type='checkbox' id='autologin' />
                <label for='autologin'>下次自动登录</label>
                <div class='submit'>
                    <a href='javascript:void(0);'>忘记密码</a>
                    <input type='submit' value='登  录' />
                </div>
            </div>

            <div class='regframe'>
                <span class='w101'>还没有帐号？<a href='/user/register'>立即注册！</a>或使用以下账号登录</span>
                <div class='share'>
                </div>
                <div class='regsubmit'>
                    <input type='submit' value='立 即 注 册' onclick='javascript:location.href="/user/register";return false;' />
                </div>
            </div>
        </div>

    </div>

<?php $this->endWidget(); ?>

</div>
</body>
</html>

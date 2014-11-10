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
        <div class='top-right'>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
            <?php echo $form->textField($model,'username', array('tabindex'=>1, 'autofocus'=>true, 'class'=>'input_text', 'placeholder'=>'用户名或邮箱', 'autocomplete'=>'off')); ?>
            <?php echo $form->passwordField($model,'password', array('tabindex'=>2, 'class'=>'input_text', 'placeholder'=>'密码', 'autocomplete'=>'off')); ?>
            <input class='login-submit' type='submit' value='登录' />
<?php $this->endWidget(); ?>
            <div class='logintool'>
                <?php echo $form->error($model,'username'); ?>
                <?php echo $form->error($model,'password'); ?>
                <?php echo $form->error($model,'verifyCode'); ?>
                <input type='checkbox' id='autologin' />
                <label for='autologin'>下次自动登录</label>
                <a class='forget-passwd' href='javascript:void(0);'>忘记密码?</a>
            </div>
        </div>
    </div>
</div>

<div class="main">
    <div class='banner'>
        <div>
            面对面更精彩！
        </div>
    </div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
    'action' => '/user/register',
	'enableClientValidation'=>true,
    'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <div class='reg'>
        <div class='regtop'>
            <div style='width:10%;background-color:rgb(202,65,97);'></div>
            <div style='width:20%;background-color:rgb(241,143,154);'></div>
            <div style='width:20%;background-color:rgb(245,111,127);'></div>
            <div style='width:20%;background-color:rgb(181,214,236);'></div>
            <div style='width:20%;background-color:rgb(106,172,214);'></div>
            <div style='width:10%;background-color:rgb(60,136,181);'></div>
        </div>
        <div class='regframe'>
            <div class='name_pic'></div>
            <div class='pass_pic'></div>
            <div class='pass_pic2'></div>
            <div class="row">
                <?php echo $form->textField($regModel,'name', array('tabindex'=>3, 'class'=>'input_text', 'placeholder'=>'用户名/邮箱', 'autocomplete'=>'off', 'required'=>true)); ?>
            </div>
            <div class="row">
                <?php echo $form->passwordField($regModel,'password', array('tabindex'=>4, 'class'=>'input_text', 'placeholder'=>'密码', 'autocomplete'=>'off', 'required'=>true)); ?>
            </div>
            <div class="row">
                <?php echo $form->passwordField($regModel,'password2', array('tabindex'=>4, 'class'=>'input_text', 'placeholder'=>'确认密码', 'autocomplete'=>'off', 'required'=>true)); ?>
            </div>

<!--
            <?php if(CCaptcha::checkRequirements()): ?>
            <div class="row">
                <div>
                <?php echo $form->textField($model,'verifyCode', array('tabindex'=>3, 'class'=>'input_text captcha', 'autocomplete'=>'off', 'placeholder'=>'请输入验证码', 'required'=>true)); ?>
                <?php $this->widget('CCaptcha'); ?>
                </div>
            </div>
            <?php endif; ?>
-->

            <div class='tiaokuan'>
                点击注册即表明你同意我们的<a href='javascript:void(0)'>条款</a>
            </div>

            <div class='regbottom'>
                <div class='ljzc'>
                    还没有帐号?<a href='javascript:void(0)'>立即注册</a>
                </div>

                <div class='ddlogin'>
                    或使用以下帐号登录
                <div class='dlwrap'>
                    <div class='dl'>
<script id='denglu_login_js' type='text/javascript' charset='utf-8'></script>
<script type='text/javascript' charset='utf-8'>
    (function() {
                var _dl_time = new Date().getTime();
                        var _dl_login = document.getElementById('denglu_login_js');
                        _dl_login.id = _dl_login.id + '_' + _dl_time;
                                _dl_login.src = 'http://static.denglu.cc/connect/logincode?appid=7293dengu1Cc8N0M3bzGtV8EgWgk63&v=1.0.2&widget=5&styletype=1&size=272_62&asyn=true&time=' + _dl_time;
                            })();
</script>
                    </div>
                </div>
                </div>

                <div class='regtool'>
                    <?php echo $form->error($regModel,'name'); ?>
                    <?php echo $form->error($regModel,'password'); ?>
                    <?php echo $form->error($regModel,'password2'); ?>
                    <div class='submit'>
                        <input type='submit' value='注册' />
                    </div>
                </div>
            </div>

<!--
            <div class='share'>
                <span>分享到以下平台：</span>
                <div class="bshare-custom icon-medium-plus"><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到微信" class="bshare-weixin"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=3a10553c-ab40-443d-9127-fa75cd643be1&amp;pophcol=2&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
            </div>
-->
        </div>

    </div>

<?php $this->endWidget(); ?>

</div>
</body>
</html>

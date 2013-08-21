<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div class="topbar">
        <div class="welcome_bar">Welcome to <span class="app_name"><?php echo CHtml::encode(Yii::app()->name); ?></span></div>
        <?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
    </div>
    <div id="header">
        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
        <div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'活动', 'url'=>array('/user/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
			),
            'firstItemCssClass'=>'first',
            'lastItemCssClass'=>'last',
		)); ?>
        </div><!-- mainmenu -->
    </div><!-- header -->

	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
<?php
$this->pageTitle=Yii::app()->name;
?>

<div class="main">
    <div class='left_content'>
        <div class='portrait'>
            <img class='portrait_img' width='120px' src='<?php echo Yii::app()->session['user']->profile->portrait;?>' />
        </div>
        <div class='portrait_name'>
            <?php echo Yii::app()->session['user']->displayname();?>
        </div>
        <div class='left_nav'>
            <div class='top_bar'></div>
            <ul>
                <li><a href='/user/index' class='selected'>我的活动</a></li>
                <li><a href='#'>活动列表</a></li>
                <li><a href='#'>创建活动</a></li>
                <li><a href='#'>个人设置</a></li>
            </ul>
        </div>
    </div>
    <div class='content'>
        <div class='content_bar'>
            <div class='new_act'>
                创建活动
            </div>
        </div>
        <div class='content_main'>
        <?php echo $content; ?>
        </div>
    </div>
</div>
	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

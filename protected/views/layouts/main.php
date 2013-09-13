<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

    <script>
        var user = {
            id: <?php echo Yii::app()->session['user']->id;?>,
            name: '<?php echo Yii::app()->session['user']->displayname();?>'
        }
    </script>
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
        <div id="mainmenu">
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'首页', 'url'=>array('/activity/list')),
                array('label'=>'活动', 'url'=>array('/user/myrelease')),
                array('label'=>'站点介绍', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'联系我们', 'url'=>array('/site/contact')),
            ),
            'firstItemCssClass'=>'first',
            'lastItemCssClass'=>'last',
        )); ?>
        </div><!-- mainmenu -->
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
    <div class='left_content'>
        <div class='portrait'>
            <img class='portrait_img' width='120px' height='120px' src='<?php echo Yii::app()->session['user']->profile->portrait;?>' />
        </div>
        <div class='portrait_name'>
            <?php echo Yii::app()->session['user']->displayname();?>
        </div>
        <div class='left_nav'>
            <div class='top_bar'>
                活动列表
            </div>
            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'发布的活动', 'url'=>array('/user/myrelease')),
                    array('label'=>'参与的活动', 'url'=>array('/user/mypart')),
                    array('label'=>'近期活动列表', 'url'=>array('/activity/list')),
                    array('label'=>'创建活动', 'url'=>array('/activity/create')),
                ),
            )); ?>

            <div class="clear"></div>
            <div class='top_bar'>
                个人设置
            </div>
            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'修改资料', 'url'=>array('/user/updateprofile')),
                    array('label'=>'头像修改', 'url'=>array('/user/portrait')),
                ),
            )); ?>
        </div>
    </div>
    <div class='content'>
        <div class='content_bar'>
            <div class='content_title'>
                <?php echo $this->title; ?>
            </div>
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


</div><!-- page -->

<div id="footer">
    Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
    All Rights Reserved.<br/>
    <?php echo Myii::powered(); ?>
</div><!-- footer -->

</body>
</html>

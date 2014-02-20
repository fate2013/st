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

<?php $this->renderPartial('/common/_main_banner'); ?>

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
        <div class='left_nav'>
            <div class='top_bar'>
                活动列表
            </div>
            <hr />
            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'发布的活动', 'url'=>array('/activity/list/channel/myrelease'),'linkOptions'=>array('class'=>'rele_act'),'active'=>$this->id=='activity'&&isset($_REQUEST['channel'])&&$_REQUEST['channel']=='myrelease'?true:false),
                    array('label'=>'参与的活动', 'url'=>array('/user/mypart'), 'linkOptions'=>array('class'=>'part_act')),
                    array('label'=>'近期活动列表', 'url'=>array('/activity/list'), 'linkOptions'=>array('class'=>'rece_act'),'active'=>$this->id=='activity'&&!isset($_REQUEST['channel'])?true:false),
                    array('label'=>'创建活动', 'url'=>array('/activity/create'), 'linkOptions'=>array('class'=>'crea_act')),
                ),
            )); ?>

            <div class="clear"></div>
        </div>
        <div class='left_nav'>
            <div class='top_bar'>
                个人设置
            </div>
            <hr />
            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'修改资料', 'url'=>array('/user/updateprofile'), 'linkOptions'=>array('class'=>'modi_info')),
                    array('label'=>'头像修改', 'url'=>array('/user/portrait'), 'linkOptions'=>array('class'=>'modi_port')),
                ),
            )); ?>
            <div class="clear"></div>
        </div>
    </div>
    <div class='content'>
        <div class='content_bar'>
            <div class='content_title'>
                <div class='ty1'>
                </div>
                <div class='ty2'>
                    活动标签
                </div>
                <div class='ty3'>
                </div>
                <div class='new_act'>
                    发布活动
                </div>
            </div>
            <div class='content_tag'>
<?php $this->renderPartial('/common/_actfilter');?>
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

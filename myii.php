<?php
require_once(dirname(__FILE__).'/yii-1.1.13/framework/yii.php');
class Myii extends Yii
{
	public static function powered()
	{
		return Yii::t('yii','Powered by {yii}.', array('{yii}'=>'ZHANG KAIHONG'));
    }
}

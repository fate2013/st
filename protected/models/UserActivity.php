<?php
class UserActivity extends CActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REFUSE = 2;

    const DEFAULT_MESSAGE = '申请加入活动';

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_activities';
	}

    public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, uid, aid', 'safe', 'on'=>'search'),
		);
	}
}

<?php

/**
 * This is the model class for table "activities".
 *
 * The followings are the available columns in table 'activities':
 * @property integer $id
 * @property string $subject
 * @property string $profile
 * @property string $start_time
 * @property integer $organizer_id
 */
class Activity extends CActiveRecord
{
    const AUTH_EVERYONE = 0;
    const AUTH_NEED_APPROVAL = 1;
    const AUTH_ONLY_INVITED = 2;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Activity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activities';
	}

    public function scopes()
    {
        return array(
        );
    }
    

    public function recently($limit=12)
    {
        $this->getDbCriteria()->mergeWith(array(
            'order'=>'created_at DESC',
            'limit'=>$limit,
        ));
        return $this;
    }



	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, type, organizer_id', 'required'),
			array('organizer_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>300),
			array('location', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subject, type, profile, organizer_id, start_time, province, city, location, auth', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'organizer' => array(self::BELONGS_TO, 'User', 'organizer_id'),
            'user_activities' => array(self::HAS_MANY, 'UserActivity', 'aid'),
            'parts' => array(self::HAS_MANY, 'User', array('uid' => 'id'), 'through'=>'user_activities', 'select'=>'parts.*,user_activities.status as status,user_activities.msg as msg','group'=>'aid,uid'),
            'userStatus' => array(self::HAS_ONE, 'UserActivity', 'aid', 'on'=>'uid='.(Yii::app()->session['user'] ? Yii::app()->session['user']->id : 0), 'select'=>'user_activities.status'),
            'comments' => array(self::HAS_MANY, 'Comment', 'aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => '活动主题',
            'type' => '活动类型',
			'profile' => '活动内容&nbsp;<span class="label_gray">（介绍下活动内容，活动地点，活动经费，活动目的等）</span>',
			'start_time' => '活动时间',
			'organizer_id' => 'Organizer',
            'province' => '地点',
            'auth' => '验证方式',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('organizer_id',$this->organizer_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function afterFind(){
        $this->start_time = substr($this->start_time, 0, 16);
        parent::afterFind();
    }
}

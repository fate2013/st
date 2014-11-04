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
class OfficialActivity extends CActiveRecord
{
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
		return 'official_activities';
	}

    public function scopes()
    {
        return array(
        );
    }
    

    public function slice($limit=12, $id=0, $mode)
    {
        if ($mode == 'last') {
            $condition = 'id>:id';
            $order = 'id asc';
        } else {
            $condition = 'id<:id';
            $order = 'id desc';
        }
        $this->getDbCriteria()->mergeWith(array(
            'condition'=>$condition,
            'params'=>array(':id' => $id),
            'order'=>$order,
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
			array('subject, type', 'required'),
			array('subject', 'length', 'max'=>300),
			array('location', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subject, type, profile, start_time, province, city, location', 'safe'),
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
            'province' => '地点',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function afterFind(){
        $this->start_time = substr($this->start_time, 0, 16);
        parent::afterFind();
    }
}

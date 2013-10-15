<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $realname
 * @property integer $age
 * @property integer $sex
 */
class User extends CActiveRecord
{

    public $password2;
	public $verifyCode;
    public $status;
    public $msg;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,password,password2', 'required'),
            array('name', 'unique'),
            array('password2', 'compare', 'compareAttribute'=>'password'),
			array('name, realname', 'length', 'max'=>20),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, realname', 'safe'),
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
            'profile'=>array(self::HAS_ONE, 'UserProfile', 'id'),
            'user_activities' => array(self::HAS_MANY, 'UserActivity', 'uid'),
            'related_acts' => array(self::HAS_MANY, 'Activity', array('aid'=>'id'), 'through'=>'user_activities', 'order'=>'created_at desc'),
            'user_friends' => array(self::HAS_MANY, 'UserFriends', 'uid'),
            'friends' => array(self::HAS_MANY, 'User', array('fid'=>'id'), 'through'=>'user_friends'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'realname' => 'Realname',
            'password' => 'Password',
			'verifyCode'=>'请输入验证码',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('sex',$this->sex);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function displayName()
    {
        return $this->name? $this->name : $this->realname;
    }

}

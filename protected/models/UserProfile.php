<?php
class UserProfile extends CActiveRecord
{

    public $image;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_profiles';
    }

    public function rules(){
        return array(
            array('portrait', 'required'),
            array('sex', 'required'),
            array('sex', 'boolean'),
			array('age', 'numerical', 'integerOnly'=>true, 'max'=>150),
            array('image', 'file', 'types'=>'jpg, jpeg, gif, png'),
			array('id, age, sex', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'image' => '头像上传',
			'age' => 'Age',
			'sex' => 'Sex',
        );
    }

    public function relations()
    {
        return array(
        );
    }

    public function genderSelection(){
        return array(
            0 => 'Male',
            1 => 'Female',
        );
    }

    public function saveProfile(){
        $this->image=CUploadedFile::getInstance($this, 'image');
        $filepath = "images/{$this->image->name}";
        if($this->image->saveAs($filepath)){
            $this->portrait = "/{$filepath}";
            $this->save();
        }
    }
}


<?php
class UserProfile extends CActiveRecord
{

    public $image;

    const DEFAULT_PORTRAIT_IMG = '/images/tx.png';
    const DEFAULT_PORTRAIT_WOMAN_IMG = '/images/tx.png';

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
            array('sex', 'required'),
            array('sex', 'boolean'),
			array('age', 'numerical', 'integerOnly'=>true, 'max'=>150),
            array('image', 'file', 'types'=>'jpg, jpeg, gif, png', 'allowEmpty'=>true, 'maxSize'=>1024*1024*2),
			array('id, portrait, age, sex, birthday', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'image' => '头像上传',
			'age' => 'Age',
			'sex' => 'Sex',
			'birthday' => '生日',
        );
    }

    public function relations()
    {
        return array(
        );
    }

    public function genderSelection(){
        return array(
            0 => 'Unknown',
            1 => 'Male',
            2 => 'Female',
        );
    }

    public function saveProfile(){
        $this->image=CUploadedFile::getInstance($this, 'image');
        if($this->image){
            $filepath = "images/{$this->image->name}";
            if($this->image->saveAs($filepath)){
                $this->portrait = "/{$filepath}";
                return $this->save();
            }
        } else {
            return $this->save();
        }
        return false;
    }
}


<?php

class UserIdentity extends CUserIdentity
{
	public function authenticate()
	{
        $user = User::model()->find('name=:name', array(':name'=>$this->username));
		if(!$user)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($user->password!==md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
            Yii::app()->session['user'] = $user;
        }
		return $this->errorCode;
	}
}

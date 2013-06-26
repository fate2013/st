<?php

class UserController extends Controller
{
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

	public function actionIndex()
	{
        $activities = Activity::model()->recently()->findAll();
        $this->render('index',array(
            'activities' => $activities,
        ));
	}

    public function actionCreateProfile(){
        $uid = Yii::app()->session['user']->id;
        $profile = UserProfile::model()->findByPk($uid);
        $profile->sex = 0;
        if(isset($_POST['UserProfile'])){
			$profile->attributes=$_POST['UserProfile'];
            $profile->saveProfile();
        }
        $this->render('create_profile', array(
            'model'=>$profile,
            'user' => Yii::app()->session['user'],
        ));
    }

    public function actionRegister()
    {
        $model = new User;

        if(isset($_POST['ajax']) && $_POST['ajax'] === 'register-form'){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        } elseif(isset($_POST['User'])){
            $model->attributes=$_POST['User']; // set all attributes with post values

            if($model->validate()){
                // save user registration
                $model->save();
                $this->redirect('index');
            }
        }

        $this->render('register',array('model'=>$model));
    }

	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->redirect(Yii::app()->user->returnUrl);
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}

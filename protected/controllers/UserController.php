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
        $activities = Activity::model()->recently()->findAll('organizer_id=:organizer_id',array(':organizer_id'=>Yii::app()->session['user']->id));
        $user = User::model()->findByPk(Yii::app()->session['user']->id);
        $relatedActs = $user->related_acts;

        $recentActs = Activity::model()->recently()->findAll();
        $this->render('index',array(
            'activities' => $activities,
            'relatedActs' => $relatedActs,
            'recentActs' => $recentActs,
        ));
	}

    public function actionMyRelease()
    {
        $activities = Activity::model()->recently(20)->findAll('organizer_id=:organizer_id',array(':organizer_id'=>Yii::app()->session['user']->id));
        $this->render('my_release',array(
            'activities' => $activities,
            'typelist' => ActTypeList::$list,
        ));
    }

    public function actionMypart()
    {
        $user = User::model()->findByPk(Yii::app()->session['user']->id);
        $activities = $user->related_acts(array('limit'=>20));

        $this->render('my_part',array(
            'activities' => $activities,
        ));
    }

    public function actionTest()
    {
        $act = Activity::model()->findByPk(1);
        $parts = $act->parts;
        foreach($parts as $part){
            var_dump($part->displayName());
        }
    }

    public function actionUpdateProfile(){
        $uid = Yii::app()->session['user']->id;
        $profile = UserProfile::model()->findByPk($uid);
        if(empty($profile)){
            $profile = new UserProfile;
            $profile->id = $uid;
        }
        $profile->sex = 0;
        if(isset($_POST['UserProfile'])){
            foreach($_POST['UserProfile'] as $key=>$value){
                if(!empty($value)){
                    $profile->$key=$value;
                }
            }
            $profile->age = date('Y') - substr($profile->birthday, 0, 4);
            if($profile->saveProfile()){
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $this->render('update_profile', array(
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
                $model->password = $model->password2 = md5($model->password);
                $succ = $model->save();
                //login
                $form = new LoginForm;
                $form->username = $model->name;
                $form->password = $_POST['User']['password'];
                $form->login();
                if($succ)
                    $this->redirect('/user/updateprofile');
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

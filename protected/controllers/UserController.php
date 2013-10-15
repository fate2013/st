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

    public function filters()
    {
        return array(
            'needLogin - login,register,captcha',
        );
    }

	public function actionIndex()
	{
        $activities = Activity::model()->recently()->findAll('organizer_id=:organizer_id',array(':organizer_id'=>Yii::app()->session['user']->id));
        $user = User::model()->findByPk(Yii::app()->session['user']->id);
        $relatedActs = $user->related_acts;

        $this->title = '参与的活动';

        $recentActs = Activity::model()->recently()->findAll();
        $this->render('index',array(
            'activities' => $activities,
            'relatedActs' => $relatedActs,
            'recentActs' => $recentActs,
        ));
	}

    public function actionMyRelease()
    {
        $time = isset($_REQUEST['time'])? $_REQUEST['time'] : false;

        $conditions = 'organizer_id=:organizer_id';
        $params = array(':organizer_id'=>Yii::app()->session['user']->id);
        if($time !== false && $time !== 'all'){
            switch($time){
            case 'near':
                $conditions .= ' and unix_timestamp(start_time)>unix_timestamp(now())+86400*7';
                break;
            case 'today':
                $conditions .= ' and to_days(start_time)=to_days(now())';
                break;
            case 'weekend':
                $conditions .= ' AND dayofweek(FROM_UNIXTIME(start_time)) in (1,7) AND YEARWEEK(FROM_UNIXTIME(start_time,"%Y-%m-%d")) = YEARWEEK(now())';
                break;
            }
        }
        $this->title = '发布的活动';
        $activities = Activity::model()->recently(20)->with('parts','organizer','userStatus')->findAll($conditions, $params);
        $this->render('my_release',array(
            'activities' => $activities,
        ));
    }

    public function actionMypart()
    {
        $user = User::model()->findByPk(Yii::app()->session['user']->id);
        $activities = $user->with('parts','organizer','userStatus')->related_acts(array('limit'=>20));

        $this->title = '参与的活动';
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

    public function actionUpdateProfile()
    {
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
                $this->redirect('/user/myrelease');
            }
        }
        $this->render('update_profile', array(
            'model'=>$profile,
            'user' => Yii::app()->session['user'],
        ));
    }

    public function actionPortrait()
    {
        if(isset($_GET['type'])){
            $img = file_get_contents('php://input');
            $filename = time().chr(97+rand(0,25)).chr(97+rand(0,25)).chr(97+rand(0,25)).'.jpg';
            $filepath = Yii::app()->basePath."/../images/portraits/{$filename}";
            file_put_contents($filepath, $img);
            $src = Yii::app()->session['user']->profile->portrait;
            unlink(Yii::app()->basePath."/..{$src}");
            Yii::app()->session['user']->profile->portrait = "/images/portraits/{$filename}";
            $result = array();
            if(Yii::app()->session['user']->profile->save()){
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
        $this->render('portrait');
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

        $this->renderPartial('register',array('model'=>$model));
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
				$this->redirect('/user/myrelease');
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

    public function actionUpdatename()
    {
        $name = $_REQUEST['name'];
        $user = Yii::app()->session['user'];
        $user->name = $name;
        if($user->save(false)){
            Yii::app()->session['user']->name = $name;
            echo 0;
        } else {
            echo 1;
        }
    }
}

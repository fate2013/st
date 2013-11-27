<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function filters()
    {
        return array(
            'needLogin - index,login,register,captcha,indexold,test',
        );
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        if(Yii::app()->session['user']){
            $this->redirect('/activity/list');
        }
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
		$this->renderPartial('index',array('model'=>$model));
	}

    public function actionIndexold()
	{
        if(Yii::app()->session['user']){
            $this->redirect('/activity/list');
        }
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
		$this->renderPartial('index_old',array('model'=>$model));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    public function actionUpload()
    {
        $file = $_FILES['upload']['tmp_name'];
        $filename = $_FILES['upload']['name'];
        $funcNum = $_GET['CKEditorFuncNum'];
        $uid = Yii::app()->session['user']->id;
        $path = Yii::app()->basePath.'/../images/'.$uid.'/'.$filename;
        $url = '/images/'.$uid.'/'.$filename;
        $message = '上传成功';
        if(!is_dir(Yii::app()->basePath.'/../images/'.$uid)){
            mkdir(Yii::app()->basePath.'/../images/'.$uid, 0775);
        }
        if(move_uploaded_file($file, $path))
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
        else
            echo '上传失败！';
    }

    public function actionBrowse()
    {
        $uid = Yii::app()->session['user']->id;
        $path = Yii::app()->basePath.'/../images/'.$uid;
        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            $file = "/images/$uid/$file";
            list($filesname,$kzm)=explode(".",$file);
            if($kzm=="gif" or $kzm=="jpg" or $kzm=="JPG" or $kzm) {
                if(!is_dir($file)){
                    $array[]=$file;
                }
            }
        }
		$this->renderPartial('browse',array('files'=>$array));
    }

    public function actionTest()
    {
        echo 'aaaa';
    }

}

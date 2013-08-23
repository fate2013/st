<?php

class ActivityController extends Controller
{
    public function actionIndex()
    {
        $aid = $_REQUEST['aid'];
        $activity = Activity::model()->findByPk($aid);
        $this->render('index',array(
            'act' => $activity,
        ));
    }

    public function actionList()
    {
        $activities = Activity::model()->recently(24)->findAll();
        $this->render('list',array(
            'activities' => $activities,
        ));
    }

    public function actionRecent()
    {
        $activities = Activity::model()->recently(24)->findAll();
        $this->render('recent',array(
            'activities' => $activities,
        ));
    }

    public function actionCreate()
    {
        $activity = new Activity;
        $activity->organizer_id = 1;
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'new-act-form'){
            echo CActiveForm::validate($activity);
            Yii::app()->end();
        } elseif(isset($_POST['Activity'])) {
            if(empty($_POST['Activity']['start_time'])){
                $_POST['Activity']['start_time'] = null;
            }
            if(isset($_POST['Activity'])){
                $activity->attributes = $_POST['Activity'];
                if($activity->save()){
                    $this->redirect(array('/user/index'));
                }
            }
        }
        $this->render('create', array('model'=>$activity));
    }
}

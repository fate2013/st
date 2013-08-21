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
        $activities = Activity::model()->recently(10)->findAll();
        $this->render('list',array(
            'activities' => $activities,
        ));
    }

    public function actionCreate()
    {
        $activity = new Activity;
        $activity->organizer_id = 1;
        if(empty($_POST['Activity']['start_time'])){
            $_POST['Activity']['start_time'] = null;
        }
        if(empty($_POST['Activity']['end_time'])){
            $_POST['Activity']['end_time'] = null;
        }
        if(isset($_POST['Activity'])){
            $activity->attributes = $_POST['Activity'];
            if($activity->save()){
                $this->redirect(array('create'));
            }
        }
        $this->render('create');
    }
}

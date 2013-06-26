<?php

class ActivityController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $activities = Activity::model()->findAll('organizer_id=:organizer_id',array(':organizer_id'=>$_GET['uid']));
        $this->render('index',array(
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

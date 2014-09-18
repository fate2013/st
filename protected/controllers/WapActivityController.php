<?php

class WapActivityController extends Controller
{
    public function filters()
    {
        return array(
            //'needLoginApi',
        );
    }

    public function actionList() {
        $channel = isset($_REQUEST['channel'])? $_REQUEST['channel'] : false;
        $time = isset($_REQUEST['time'])? $_REQUEST['time'] : false;
        $type = isset($_REQUEST['type'])? $_REQUEST['type'] : false;
        if($channel === false || $channel == 'list'){
            $conditions = '';
            $params = array();
        } elseif($_REQUEST['channel'] == 'myrelease'){
            $conditions = 'organizer_id=:organizer_id';
            $params = array(':organizer_id'=>Yii::app()->session['user']->id);
        }
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
        if($type !== false && $type !== 'all'){
            $conditions .= ' and type=:type';
            $params[':type'] = $type;
        }
        $activities = Activity::model()->recently(24)->with('parts','organizer','userStatus')->findAll($conditions, $params);
        $this->title = '活动列表';

        $this->renderJson($activities);
    }

    public function actionIndex()
    {
        $aid = $_REQUEST['aid'];
        $activity = Activity::model()->findByPk($aid);
        $this->breadcrumbs=array($activity->subject);
        $this->title = "活动：{$activity->subject}";
        $this->render('index',array(
            'act' => $activity,
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
        if(isset($_REQUEST['aid'])){
            $aid = $_REQUEST['aid'];
            $activity = Activity::model()->findByPk($aid);
            if(!$activity){
                $activity = new Activity;
            }
        } else {
            $activity = new Activity;
        }
        $activity->organizer_id = Yii::app()->session['user']->id;
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
                    $this->redirect(array('/user/myrelease'));
                }
            }
        }
        $this->render('create', array('model'=>$activity));
    }

    public function actionJoin()
    {
        $aid = $_REQUEST['aid'];
        $activity = Activity::model()->findByPk($aid);
        if($activity->auth == Activity::AUTH_EVERYONE){
            $status = UserActivity::STATUS_APPROVED;
        } elseif($activity->auth == Activity::AUTH_NEED_APPROVAL){
            $status = UserActivity::STATUS_PENDING;
        }
        $ua = new UserActivity;
        $ua->uid = Yii::app()->session['user']['id'];
        $ua->aid = $aid;
        $ua->status = $status;
        if($ua->save()){
            echo $status;
        } else {
            echo -1;
        }
    }

    public function actionQuit()
    {
        $aid = $_REQUEST['aid'];
        $ua = UserActivity::model()->findByAttributes(array('aid'=>$aid, 'uid'=>Yii::app()->session['user']['id']));
        if($ua->delete()){
            echo 0;
        } else {
            echo 1;
        }
    }

    public function actionApprove()
    {
        $aid = $_REQUEST['aid'];
        $uid = $_REQUEST['uid'];
        $ua = UserActivity::model()->findByAttributes(array('aid'=>$aid, 'uid'=>$uid));
        $ua->status = UserActivity::STATUS_APPROVED;
        if($ua->save()){
            echo 0;
        } else {
            echo 1;
        }
    }

    public function actionRefuse()
    {
        $aid = $_REQUEST['aid'];
        $uid = $_REQUEST['uid'];
        $ua = UserActivity::model()->findByAttributes(array('aid'=>$aid, 'uid'=>$uid));
        $ua->status = UserActivity::STATUS_REFUSE;
        if($ua->save()){
            echo 0;
        } else {
            echo 1;
        }
    }

    public function actionCommentCreate()
    {
        $aid = $_REQUEST['aid'];
        $cid = isset($_REQUEST['cid'])? $_REQUEST['cid'] : false;
        if($cid){
            $replyComment = Comment::model()->findByPk($cid);
            $replyto = $replyComment->creator;
            $replytoname = $replyto->displayname();
        } else {
            $replytoname = false;
        }
        $content = $_REQUEST['content'];
        $comment = new Comment;
        $comment->aid = $aid;
        if($cid !== false){
            $comment->cid = $cid;
        }
        $comment->content = $content;
        $comment->uid = Yii::app()->session['user']->id;
        $user = Yii::app()->session['user'];
        if($comment->save()){
            echo CJSON::encode(array(
                'cid' => $comment->id,
                'uid' => $user->id,
                'content'=>$content,
                'creator'=>$user->displayname(),
                'createtime'=>TimeUtil::getLastTime(date('Y-m-d H:i:s')),
                'portrait'=>$user->profile->portrait,
                'replyto' => $replytoname,
            ));
        } else {
            echo -1;
        }
    }

    public function actionListComment()
    {
        $aid = $_REQUEST['aid'];
        $comments = Comment::model()->with('creator', 'replyto')->findAll(array(
            'condition'=>'t.aid=:aid',
            'params'=>array(':aid'=>$aid),
            'order'=>'t.created_at desc'));
        $result = array();
        foreach($comments as $c){
            $result[] = array(
                'cid' => $c->id,
                'uid' => $c->creator->id,
                'portrait' => $c->creator->profile->portrait,
                'creator' => $c->creator->displayname(),
                'content' => $c->content,
                'createtime' => TimeUtil::getLastTime($c->created_at),
                'replyto' => $c->replyto? $c->replyto->displayname() : null,
            );
        }
        echo CJSON::encode($result);
    }

    public function actionDelcomment()
    {
        $cid = $_REQUEST['cid'];
        if(Comment::model()->deleteByPk($cid)){
            echo 0;
        } else {
            echo 1;   
        }
    }
}

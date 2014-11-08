<?php

class WapOfficialActivityController extends Controller
{
    public function filters()
    {
        return array(
            //'needLoginApi',
        );
    }

    public function actionList() {
        $type = isset($_REQUEST['type'])? $_REQUEST['type'] : false;
        $lastId = isset($_REQUEST['last_id'])? $_REQUEST['last_id'] : 0;
        $prevId = isset($_REQUEST['prev_id'])? $_REQUEST['prev_id'] : 0;
        if ($lastId && $prevId) {
            echo 'Should chroose one of last_id or prev_id, not both';
            exit();
        }
        $mode = $lastId? 'last' : ($prevId? 'prev' : 'default');
        $id = $lastId? $lastId : $prevId;
        $conditions = '';
        $params = array();
        if($type !== false && $type !== 'all'){
            $conditions .= 'type=:type and ';
            $params[':type'] = $type;
        }
        if (substr($conditions, strlen($conditions) - 5) == ' and ') {
            $conditions = substr($conditions, 0, strlen($conditions) - 5);
        }
        $activities = OfficialActivity::model()->slice(12, $id, $mode)->findAll($conditions, $params);
        $this->title = '活动列表';

        $this->renderJson($activities);
    }

}

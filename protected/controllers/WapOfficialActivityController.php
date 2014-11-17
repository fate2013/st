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
            $this->error(406, 'Should chroose one of last_id or prev_id, not both');
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

        $this->renderJson($activities);
    }

    public function actionDetail() {
        if (!isset($_REQUEST['id'])) {
            $this->error(404, 'ERROR occur:No id input');
        }
        $id = $_REQUEST['id'];
        $activity = OfficialActivity::model()->findByPk($id);
        $this->renderJson($activity);
    }

}

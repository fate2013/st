<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public $title;

    public function filterNeedLogin($filterChain) {
        if(empty(Yii::app()->session['user'])){
            $this->redirect('/user/login');
            Yii::app()->end();
        }
        $filterChain->run();
    }

    public function filterNeedLoginApi($filterChain) {
        if(empty(Yii::app()->session['user'])){
            $this->error('101', 'Need login first');
        }
        $filterChain->run();
    }

    public function error($code, $msg) {
        header("Content-type:json/application;charset=utf-8");
        echo CJSON::encode(array(
            'code' => $code,
            'msg' => $msg,
        ));
        Yii::app()->end();
    }

    public function renderJson($data) {
        header("Content-type:json/application;charset=utf-8");
        echo CJSON::encode($data);
        Yii::app()->end();
    }
}

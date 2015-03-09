<?php
/**
 * DefaultController.php
 *
 * API REST pour géré l'application EGPC
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class ApiController extends TeeoController {

    const moduleTitle = "TEEO";

    public $percent = 60; //TODO link it to unit test

    protected function beforeAction($action)
    {
    parent::initPage();
    /*if(!Yii::app()->session["user"])
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/login"));
    else */
       return parent::beforeAction($action);
    }

    public function actions()
    {
        /*$userMap = Api::getUserMap();
        array_push($userMap["children"], Api::$apis["saveUserRDF"]);
        array_push( $this->sidebar1 , $userMap );*/

        array_push( $this->sidebar1 , Api::getNotificationActions() );

        //array_push($this->sidebar1, Api::getEventMap());
        //array_push($this->sidebar1, Api::getCommunicationMap());
        //array_push($this->sidebar1, Api::getAdminPHMap());

        return Api::buildActionMap($this->sidebar1);
    }

    public function actionLang($val)
    {
        Yii::app()->language = $val;
        Yii::app()->session["lang"] = $val;
        $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person"));
    }


}
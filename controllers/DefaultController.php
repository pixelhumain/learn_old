<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends LearnController {

  protected function beforeAction($action)
	{
    parent::initPage();
	  return parent::beforeAction($action);
	}

  /**
   * List all the latest observations
   * @return [json Map] list
  */
	public function actionIndex() 
	{
    $events = PHDB::findAndSort( PHType::TYPE_EVENTS, array(), array("created"=>1 ), 5);
    $todos = PHDB::find(Todo::collection);
    $lastNews = News::getLatest();

    $this->render("index",array( "events"=>$events,
                                 "todos"=>$todos,
                                 "lastNews"=>$lastNews ));      
  }
   
}
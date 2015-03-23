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
    $events = PHDB::find(PHType::TYPE_EVENTS);
    $todos = PHDB::find(Todo::collection);

    $this->render("index",array( "events"=>$events,
                                 "todos"=>$todos ));      
  }
   
}
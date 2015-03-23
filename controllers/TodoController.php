<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH en terme de gestion d'evennement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class TodoController extends LearnController {
    
  protected function beforeAction($action) {
    parent::initPage();
    return parent::beforeAction($action);
  }

   public function actionIndex() {
     $todos = PHDB::find(PHType::TYPE_EVENTS);
     $this->render("index",array("todos"=>$todos));
  }

  public function actionEdit($id) {
      //menu sidebar
      /*array_push( $this->sidebar1, array("href"=>Yii::app()->createUrl('evenement/creer'), "iconClass"=>"icon-plus", "label"=>"Ajouter"));
      array_push( $this->sidebar1, array( "label"=>"Modifier", "iconClass"=>"icon-pencil-neg","onclick"=>"openModal('todoForm','group','$id','dynamicallyBuild')" ) );
      array_push( $this->sidebar1, array( "label"=>"Participant", "iconClass"=>"icon-users","onclick"=>"openModal('todoParticipantForm','group','$id','dynamicallyBuild')" ) );
      */ 
      $todo = Todo::getById($id);
      $citoyens = array();
      $organizations = array();
      if (isset($todo["attendees"]) && !empty($todo["attendees"])) 
	    {
	      foreach ($todo["attendees"] as $id => $e) 
	      {
	      	
	      	if (!empty($todo)) {
	      		if($e["type"] == "citoyens"){
	      			$citoyen = PHDB::findOne( PHType::TYPE_CITOYEN, array( "_id" => new MongoId($id)));
	      			array_push($citoyens, $citoyen);
	      		}else if($e["type"] == "organizations"){
	          		$organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS, array( "_id" => new MongoId($id)));
	          		array_push($organizations, $organization);
	      		}
	        } else {
	         // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
	        }  	
	      }
	    }

      if(isset($todo["key"]) )
          $this->redirect(Yii::app()->createUrl('evenement/key/id/'.$todo["key"]));
      else
        $this->render("edit",array('todo'=>$todo, 'organizations'=>$organizations, 'citoyens'=>$citoyens));
  }
  
  public function actionPublic($id){
    //get The todo Id
    if (empty($id)) {
      throw new CommunecterException("The todo id is mandatory to retrieve the todo !");
    }

    $todo = Todo::getPublicData($id);
    
    $this->title = (isset($todo["name"])) ? $todo["name"] : "";
    $this->subTitle = (isset($todo["description"])) ? $todo["description"] : "";
    $this->pageTitle = "Communecter - Informations publiques de ".$this->title;


    $this->render("public", array("todo" => $todo));
  }

 

 
    public function actionSave() {
	    if( isset($_POST['todo']['name']) && !empty($_POST['todo']['name']))
		  {
		    //TODO check by key
        $res = Todo::save($_POST);
        echo json_encode($res);
         
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
    
	/**
	 * Delete an entry from the group table using the id
	 */
    public function actionDelete() 
    {
      $todo = PHDB::findOne(Todo::collection,array("_id"=>new MongoId($_POST["id"])));

      if( $todo )
      {
        $result = Todo::delete($_POST["id"]);
        echo json_encode($result); 
      } else 
        echo json_encode(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));

		  exit;
	}
  
}
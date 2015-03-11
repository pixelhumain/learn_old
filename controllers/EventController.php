<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH en terme de gestion d'evennement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class EventController extends LearnController {
    const moduleTitle = "Évènement";
    
  protected function beforeAction($action) {
    parent::initPage();
    return parent::beforeAction($action);
  }

   public function actionIndex() {
     $events = PHDB::find(PHType::TYPE_EVENTS);
     $this->render("index",array("events"=>$events));
  }

  public function actionEdit($id) {
      //menu sidebar
      /*array_push( $this->sidebar1, array("href"=>Yii::app()->createUrl('evenement/creer'), "iconClass"=>"icon-plus", "label"=>"Ajouter"));
      array_push( $this->sidebar1, array( "label"=>"Modifier", "iconClass"=>"icon-pencil-neg","onclick"=>"openModal('eventForm','group','$id','dynamicallyBuild')" ) );
      array_push( $this->sidebar1, array( "label"=>"Participant", "iconClass"=>"icon-users","onclick"=>"openModal('eventParticipantForm','group','$id','dynamicallyBuild')" ) );
      */ 
      $event = Event::getById($id);
      $citoyens = array();
      $organizations = array();
      if (isset($event["attendees"]) && !empty($event["attendees"])) 
	    {
	      foreach ($event["attendees"] as $id => $e) 
	      {
	      	
	      	if (!empty($event)) {
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

      if(isset($event["key"]) )
          $this->redirect(Yii::app()->createUrl('evenement/key/id/'.$event["key"]));
      else
        $this->render("edit",array('event'=>$event, 'organizations'=>$organizations, 'citoyens'=>$citoyens));
  }
  
  public function actionPublic($id){
    //get The event Id
    if (empty($id)) {
      throw new CommunecterException("The event id is mandatory to retrieve the event !");
    }

    $event = Event::getPublicData($id);
    
    $this->title = (isset($event["name"])) ? $event["name"] : "";
    $this->subTitle = (isset($event["description"])) ? $event["description"] : "";
    $this->pageTitle = "Communecter - Informations publiques de ".$this->title;


    $this->render("public", array("event" => $event));
  }

 

 
    public function actionSave() {
	    if( isset($_POST['title']) && !empty($_POST['title']))
		  {
		    //TODO check by key
            $event = PHDB::findOne(PHType::TYPE_EVENTS,array( "name" => $_POST['title']));
            if(!$event)
            { 
               //validate isEmail
               $email = (isset($_POST['email'])) ? $_POST['email'] : Yii::app()->session["userEmail"];
               if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) { 
                    $res = Event::saveEvent($_POST);
                    echo json_encode($res);
               } else
                   echo json_encode(array("result"=>false, "msg"=>"Vous devez remplir un email valide."));
            } else
                   echo json_encode(array("result"=>false, "msg"=>"Cette Evenement existe déjà."));
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
    
	/**
	 * Delete an entry from the group table using the id
	 */
    public function actionDelete() 
    {
      $event = PHDB::findOne(PHType::TYPE_EVENTS,array("_id"=>new MongoId($_POST["id"])));
	    if( Yii::app()->session['userEmail'] == $event["email"])
	    {
            if( $event )
            {
                  $result = Event::deleteEvent($_POST["id"]);
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));
  		} else
  		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		  exit;
	}
  
}
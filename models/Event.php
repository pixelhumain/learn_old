<?php 
class Event {

	/**
	 * get an event By Id
	 * @param type $id : is the mongoId of the event
	 * @return type
	 */
	public static function getById($id) {
	  	return PHDB::findOne( PHType::TYPE_EVENTS,array("_id"=>new MongoId($id)));
	}

	/**
	 * Get an event from an id and return filter data in order to return only public data
	 * @param type $id 
	 * @return event structure
	 */
	public static function getPublicData($id) {
		//Public datas 
		$publicData = array (
		);

		//TODO SBAR = filter data to retrieve only publi data	
		$event = Event::getById($id);
		if (empty($event)) {
			throw new CommunecterException("The event id is unknown ! Check your URL");
		}

		return $event;
	}

	/**
   *
   * @return [json Map] list
   */
	public static function saveEvent($params)
	{
	    $attendees = array();
	    $attendees[ Yii::app()->session["userId"] ] = array( "type" => PHType::TYPE_CITOYEN );
	    $new = array(
			'email' => Yii::app()->session["userEmail"],
			"name" => $params['title'],
	          'type' => $params['type'],
				      'public'=>true,//$params['public'],
	          'created' => time(),
	          "organizer" => array( 
	              array(
	                  "id" => Yii::app()->session["userId"],
	                  "type" => PHType::TYPE_CITOYEN
	              )
	          ),
	          "attendees" => array($attendees),
	          "allDay" => $params['allDay'],
	    );
	    //sameAs      
	    if(!empty($params['content']))
	         $new["description"] = $params['content'];
	    if(!empty($params['end']))
	         $new["endDate"] = $params['end'];
	    if(!empty($params['start']))
	         $new["startDate"] = $params['start'];

	    PHDB::insert(PHType::TYPE_EVENTS,$new);
	    
	    //add the association to the users association list
	    $where = array("_id" => new MongoId(Yii::app()->session["userId"]));
	    PHDB::update(PHType::TYPE_CITOYEN,$where, array('$addToSet' => array("events"=>$new["_id"])));	
	    //send validation mail
	    //TODO : make emails as cron jobs
	    /*$message = new YiiMailMessage;
	    $message->view = 'validation';
	    $message->setSubject('Confirmer votre compte Pixel Humain');
	    $message->setBody(array("user"=>$new["_id"]), 'text/html');
	    $message->addTo("oceatoon@gmail.com");//$params['registerEmail']
	    $message->from = Yii::app()->params['adminEmail'];
	    Yii::app()->mail->send($message);*/
	    
	    //TODO : add an admin notification
	    //Notification::saveNotification(array("type"=>NotificationType::ASSOCIATION_SAVED,"user"=>$new["_id"]));
	    return array("result"=>true, "msg"=>"Votre évènement est communecté.", "id"=>$new["_id"]);
	}

	/**
	   *
	   * @return [json Map] list
	   */
		public static function deleteEvent($id)
		{
		    PHDB::remove( PHType::TYPE_EVENTS, array( "_id" => new MongoId($id) ) );
            PHDB::update(PHType::TYPE_CITOYEN,array( "_id" => new MongoId( Yii::app()->session["userId"] ) ) , 
                                              array( '$pull' => array("events"=>$id)));
            return array("result"=>true, "msg"=>"Votre évènement est retiré.");
		}
}
?>
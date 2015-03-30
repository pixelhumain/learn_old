<?php 
class News {

	const collection = "news";
	/**
	 * get an event By Id
	 * @param type $id : is the mongoId of the event
	 * @return type
	 */
	public static function getById($id) {
	  	return PHDB::findOne( self::collection, array("_id"=>new MongoId($id) ) );
	}

	public static function getLatest() {
	  	return PHDB::findAndSort( self::collection, array(), array("created"=>-1 ), 1);
	}


	/**
   *
   * @return [json Map] list
   */
	public static function save($params)
	{
		$todo = $params["todo"];
	    $attendees[ Yii::app()->session["userId"] ] = array( "type" => PHType::TYPE_CITOYEN );
	    $new = array(
			"name" => $todo['name'],
	        'type' => (isset($todo['type'])) ? $todo['type'] : "todo",
				      'public'=>true,
	        'created' => time()
	    );
	    PHDB::insert(self::collection, $new);
	    
	    return array("result"=>true, "msg"=>"Todo saved", "id"=>$new["_id"]);
	}

	/**
	   *
	   * @return [json Map] list
	   */
	public static function delete($id)
	{
	    PHDB::remove( self::collection, array( "_id" => new MongoId($id) ) );
        return array("result"=>true, "msg"=>"REMOVED with Success.");
	}
}
?>
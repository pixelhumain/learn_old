<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class NodeController extends LearnController {
  

	/**
	 * opens on a country
	 * @param string $type : pays || region || commune
	 * @param $id : france || code postale
	 */
	public function actionIndex() {
	    $this->render("index",array("example"=>"FAit tourner ton application Node ICI"));
	}
	
}
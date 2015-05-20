<?php
/**
 * @author: Raphael RIVIERE 
 * Date: 18/05/15
 */

	require_once __DIR__ . "/../../../pixelhumain/ph/vendor/facebook-php-sdk-v4/autoload.php"; //include autoload from SDK folder

			//import required class to the current scope
			use Facebook\FacebookSession;
			use Facebook\FacebookRequest;
			use Facebook\GraphUser;
			use Facebook\FacebookRedirectLoginHelper;
	/*Yii::import('facebook.autoload.php', true);
			Yii::import('facebook.src.Facebook.FacebookSession', true);
			Yii::import('facebook.src.Facebook.FacebookRequest', true);
			Yii::import('facebook.src.Facebook.GraphUser', true);
			Yii::import('facebook-php-sdk-v4.src.Facebook.FacebookRedirectLoginHelper', true);*/
	

	class FacebookController extends LearnController
	{
		protected function beforeAction($action) 
		{
			parent::initPage();
			return parent::beforeAction($action);
		}

		public function actionIndex() 
  		{
  			/*
			 // Permissions required
			$redirect_url = 'http://127.0.0.1/ph/learn/facebook/'; //Apres la connexion via FB, on est redirige vers cette URL*/
			
			$required_scope = 'public_profile, publish_actions, read_custom_friendlists, user_groups, user_managed_groups ';
			$paramFacebook = Yii::app()->params["facebook"];
      		FacebookSession::setDefaultApplication($paramFacebook["app_id"] , $paramFacebook["app_secret"]);
			$helper = new FacebookRedirectLoginHelper($paramFacebook["redirect_url"]);
			

			try 
			{
				//$sessionFB2 = FacebookSession::newAppSession();
		  		$sessionFB = $helper->getSessionFromRedirect();
		  		$token_url = "https://graph.facebook.com/oauth/access_token?" .
                				"client_id=" . $paramFacebook["app_id"] .
                				"&client_secret=" . $paramFacebook["app_secret"] .
                				"&grant_type=client_credentials";
				$app_token = file_get_contents($token_url);
				Yii::app()->session["FB_token"] = substr($app_token, 13);
		  		//$sessionFB = new FacebookSession($token);
		  		
			} 
			catch(FacebookRequestException $ex) 
			{
				die(" Error : " . $ex->getMessage());
			} 
			catch(\Exception $ex)
			{
				die(" Error : " . $ex->getMessage());
			}

			if ($sessionFB) //if we have the FB session	
			{ 
				
				try 
				{
					$user_profile = (new FacebookRequest($sessionFB, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
					$list_groups = (new FacebookRequest($sessionFB, 'GET', '/me/groups'))->execute()->getGraphObject(GraphUser::className());
					
					Yii::app()->session["FB_user_detail"] = $user_profile->asArray();
					Yii::app()->session["FB_user_groups"] = current($list_groups->asArray());

					
					if(isset(Yii::app()->session["FB_user_detail"]["first_name"]))
						$user_first_name_fb = Yii::app()->session["FB_user_detail"]["first_name"];
					else
						$user_first_name_fb = "";


					if(isset(Yii::app()->session["FB_user_detail"]["last_name"]))
						$user_last_name_fb = Yii::app()->session["FB_user_detail"]["last_name"];
					else
						$user_last_name_fb = "";

					$this->render("listgroups",array(
											"first_name"=>$user_first_name_fb,
											"last_name"=>$user_last_name_fb,
											"groups"=>Yii::app()->session["FB_user_groups"]
											));


				} 
				catch(FacebookRequestException $ex) 
				{
					die(" Error : " . $ex->getMessage());
				} 
				catch(\Exception $ex)
				{
					die(" Error : " . $ex->getMessage());
				}

				
			}
			else
			{
				if(isset(Yii::app()->session["FB_user_detail"]))
				{

					if(isset(Yii::app()->session["FB_user_detail"]["first_name"]))
						$user_first_name_fb = Yii::app()->session["FB_user_detail"]["first_name"];
					else
						$user_first_name_fb = "";


					if(isset(Yii::app()->session["FB_user_detail"]["last_name"]))
						$user_last_name_fb = Yii::app()->session["FB_user_detail"]["last_name"];
					else
						$user_last_name_fb = "";

					$this->render("listgroups",array(
											"first_name"=>$user_first_name_fb,
											"last_name"=>$user_last_name_fb,
											"groups"=>Yii::app()->session["FB_user_groups"]
											));
				}
				else
				{
					$login_url = $helper->getLoginUrl(array( 'scope' => $required_scope) );
					$this->render("index",array("login_url"=>$login_url));
				}
				
			}
  		}


  		
  		public function actionGroup($idgroup) 
  		{
  			
  			$paramFacebook = Yii::app()->params["facebook"];
  			FacebookSession::setDefaultApplication($paramFacebook["app_id"] , $paramFacebook["app_secret"]);
  			$required_scope = 'public_profile, publish_actions, read_custom_friendlists, user_groups, user_managed_groups ';
  			$url = 'http://127.0.0.1/ph/learn/facebook/group/idgroup/'.$idgroup ;
			$helper = new FacebookRedirectLoginHelper($url);

			try 
			{
		  		$sessionFB = $helper->getSessionFromRedirect();			  		
			} 
			catch(FacebookRequestException $ex) 
			{
				die(" Error : " . $ex->getMessage());
			} 
			catch(\Exception $ex)
			{
				die(" Error : " . $ex->getMessage());
			}
			//$sessionFB = connexionFB('http://127.0.0.1/ph/learn/facebook/group/idgroup/'.$idgroup);
			if ($sessionFB) //if we have the FB session	
			{ 
  				try 
				{
			  		$group_detail = (new FacebookRequest($sessionFB, 'GET', '/'.$idgroup))->execute()->getGraphObject(GraphUser::className());
					Yii::app()->session["FB_group_detail"] = $group_detail->asArray();

					$this->render("group",array("group_detail"=>Yii::app()->session["FB_group_detail"]));
			  		
				} 
				catch(FacebookRequestException $ex) 
				{
					die(" Error : " . $ex->getMessage());
				} 
				catch(\Exception $ex)
				{
					die(" Error : " . $ex->getMessage());
				}
			}
			else
			{
				$login_url = $helper->getLoginUrl(array( 'scope' => $required_scope) );
				//header('Location: '.$login_url);
				$this->redirect($login_url);
			}

  			
  		}


  		public function actionShare() 
  		{
  			if(isset($_POST["textToRecup"]))
  			{
  				echo Rest::json(array('result'=> true,
  													'test'=> $_POST["textToRecup"]));
  				Yii::app()->session["FB_text"] = $_POST["textToRecup"];
  			}
  			else
  			{
  				$this->render("group",array("group_detail"=>Yii::app()->session["FB_group_detail"]));
			}
				/*$paramFacebook = Yii::app()->params["facebook"];
      			FacebookSession::setDefaultApplication($paramFacebook["app_id"] , $paramFacebook["app_secret"]);
      			$required_scope = 'public_profile, publish_actions, read_custom_friendlists, user_groups, user_managed_groups ';
      			$url = 'http://127.0.0.1/ph/learn/facebook/share/';
				$helper = new FacebookRedirectLoginHelper($url);

				try 
				{
			  		$sessionFB = $helper->getSessionFromRedirect();			  		
				} 
				catch(FacebookRequestException $ex) 
				{
					die(" Error : " . $ex->getMessage());
				} 
				catch(\Exception $ex)
				{
					die(" Error : " . $ex->getMessage());
				}
				
				if ($sessionFB) //if we have the FB session	
				{
	  				try 
					{
				  		if(isset(Yii::app()->session["FB_text"]))
				  		{
				  			
				  			$request = new FacebookRequest($sessionFB,'POST',
				  											'/'.Yii::app()->session["FB_group_detail"]['id'].'/feed', 
					  										array ('message' => Yii::app()->session["FB_text"],
															'link' => 'http://www.pixelhumain.com/',));
							$response = $request->execute();
							$graphObject = $response->getGraphObject();
				  		}
					} 
					catch(FacebookRequestException $ex) 
					{
						die(" Error : " . $ex->getMessage());
					} 
					catch(\Exception $ex)
					{
						die(" Error : " . $ex->getMessage());
					}
					
				}
				else
				{
					$login_url = $helper->getLoginUrl(array( 'scope' => $required_scope) );
					$this->redirect($login_url);
				}*/
  			
  		}


  		public function connexionFB($url) 
  		{

  			/*$paramFacebook = Yii::app()->params["facebook"];
  			FacebookSession::setDefaultApplication($paramFacebook["app_id"] , $paramFacebook["app_secret"]);
  			$required_scope = 'public_profile, publish_actions, read_custom_friendlists, user_groups, user_managed_groups ';
  			//$url = 'http://127.0.0.1/ph/learn/facebook/group/idgroup/'.$idgroup ;
			$helper = new FacebookRedirectLoginHelper($url);

			try 
			{
		  		$sessionFB = $helper->getSessionFromRedirect();			  		
			} 
			catch(FacebookRequestException $ex) 
			{
				die(" Error : " . $ex->getMessage());
			} 
			catch(\Exception $ex)
			{
				die(" Error : " . $ex->getMessage());
			}

			return $sessionFB;*/
  		}
	}
?>
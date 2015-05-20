<?php
/**
 * @author: Raphael RIVIERE 
 * Date: 18/05/15
 */

	require_once __DIR__ . "/../facebook-php-sdk-v4/autoload.php"; //include autoload from SDK folder

			//import required class to the current scope
			use Facebook\FacebookSession;
			use Facebook\FacebookRequest;
			use Facebook\GraphUser;
			use Facebook\FacebookRedirectLoginHelper;

	

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
  			
  			if(isset($_POST["textToRecup"]))
  			{
  				$text = $_POST["textToRecup"];
  			}
  			else
  			{
  				$text = "Rien";
  			}

  			$this->render("group",array("idgroup"=>$idgroup,
										"textFB"=> $text));


  			/*$paramFacebook = Yii::app()->params["facebook"];
      		FacebookSession::setDefaultApplication($paramFacebook["app_id"] , $paramFacebook["app_secret"]);
      		$required_scope = 'public_profile, publish_actions, read_custom_friendlists, user_groups, user_managed_groups ';
      		$url = 'http://127.0.0.1/ph/learn/facebook/group/idgroup/'.$idgroup ;
			$helper = new FacebookRedirectLoginHelper($url);
			
			try 
			{
		  		$sessionFB = $helper->getSessionFromRedirect();
		  		//$sessionFB = new FacebookSession(Yii::app()->session["FB_token"]);
		  		//$sessionFB->validate();
		  		
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
			  		//$session = $helper->getSessionFromRedirect();
					$group_detail = (new FacebookRequest($sessionFB, 'GET', '/'.$idgroup))->execute()->getGraphObject(GraphUser::className());
			  		Yii::app()->session["FB_group_detail"] = $group_detail->asArray();
			  		
			  		if(isset(Yii::app()->session["FB_text"]))
			  		{
			  			$request = new FacebookRequest($sessionFB,'POST','/'.$idgroup.'/feed', 
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
		 	
		 	   	
		 	   	
				if(isset(Yii::app()->session["FB_text"]))
				{
			  		$text_fb = Yii::app()->session["FB_text"];
			  		Yii::app()->session["FB_test2"] = "ici";
			  	}
			  	else
			  	{
			  		$text_fb = '';
			  		
			  	}
				$this->render("group",array("idgroup"=>Yii::app()->session["FB_group_detail"],
											"textFB"=> $text_fb,
											"testFB"=> Yii::app()->session["FB_test2"]));
			}
			else
			{
				$login_url = $helper->getLoginUrl(array( 'scope' => $required_scope) );
				//$this->render("index",array("login_url"=>$login_url));
				header('Location: '.$login_url);
			}*/
  		}


	}
?>
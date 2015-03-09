<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class LearnController extends Controller
{
  public $version = "V.0.214";
  
  public $title = "Learn";
  public $subTitle = "Learn about CTK modules";
  public $pageTitle = "CTK Learning ";
  
  public static $moduleKey = "learn";
  
  public $keywords = "page keywords for this module";
  public $description = "page description for this module";

  public $projectName = "Learn CTK modules";
  public $projectImage = "/images/CTK.png";
  public $projectImageL = "/images/logo.png";
  
  public $footerText = "2009 - 2015";
  public $footerImages = array(
      array("img"=>"/images/logoORD.PNG","url"=>"http://openrd.io"),
      array("img"=>"/images/logo_region_reunion.png","url"=>"http://www.regionreunion.com"),
      array("img"=>"/images/technopole.jpg","url"=>"http://technopole-reunion.com"),
      array("img"=>"/images/Logo_Licence_Ouverte_noir_avec_texte.gif","url"=>"https://data.gouv.fr"),
      array("img"=>'/images/blog-github.png',"url"=>"https://github.com/pixelhumain/pixelhumain"),
      array("img"=>'/images/opensource.gif',"url"=>"http://opensource.org/"));

   public $lang = array("fr" => array("label"=>"french"),
                       "en" => array("label"=>"english"));

  const theme = "ph-dori";
  public $themeStyle = "theme-style11";//3,4,5,7,9

  public $notifications = array();
  public $sidebar1 = array(
    array('label' => "Management", "key"=>"management","iconClass"=>"fa fa-home","getChildren"=> "management" ),
    array('label' => "Smart Immo", "key"=>"smartimmo","iconClass"=>"fa fa-home",
        "children"=> array(
                  "Generali" => array( "label"=>"Dev","key"=>"generali", "href"=>"/twh/smartimmo/generali"),
          "Generali2" => array( "label"=>"Générali","key"=>"generali2", "href"=>"/twh/smartimmo/generali2")
                ))
    );
  
  public $toolbarMenuAdd = array(
     
    array('label' => "Perimeters", "key"=>"perimeter",
        "children"=> array(
          "perimeters" => array( "label"=>"Add a Perimeter","key"=>"perimeters", "href"=>"/ph/twh/perimeter", "iconStack"=>array("fa fa-circle-o fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
          "sites" => array( "label"=>"Add a site","key"=>"sites", "href"=>"/ph/twh/perimeter", "iconStack"=>array("fa fa-circle fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
        )
    ),
    
  );

public $toolbarMenuMaps = array(
    array('label' => "Meters",  'desc' => "Analyse Precisly your energy Usage", "class"=>"ajaxSV", "onclick"=>"openSubView('Meters', '/twh/sig/meters', null)",     'extra' => "see the map",  "iconClass"=>"fa-sitemap text-dark-green"),
    array('label' => "Buildings", 'desc' => "See all buildings", "class"=>"ajaxSV", "onclick"=>"openSubView('Buildings', '/twh/sig/buildings', null)",  'extra' => "see the map",  "iconClass"=>"fa-building text-dark-danger"),
    array('label' => "Events",  'desc' => "See currently on-going events","class"=>"ajaxSV", "onclick"=>"openSubView('Events', '/twh/sig/events', null)",     'extra' => "see the map",  "iconClass"=>"fa-calendar text-purple"),
);

public $pages = array(
  "default" => array(
    "index"=>array("href"=>"/ph/twh/default/index",'title' => "Index",'title' => "Energy Dashboard"),
  ),
);

function initPage()
{
    $cs = Yii::app()->getClientScript();
    //this Js lib contains any global module specific Js variables or functions
    $cs->registerScriptFile($this->module->assetsUrl.'/js/twh.js' , CClientScript::POS_END);

    //echo Yii::app()->controller->id."/".Yii::app()->controller->action->id;
    /*if( Yii::app()->controller->id."/".Yii::app()->controller->action->id != "person/login" && Yii::app()->controller->id."/".Yii::app()->controller->action->id != "person/authenticate" && !Yii::app()->session["user"] )
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/login"));
*/
    //$teeoUserMenu = TeeoApi::menuItems(null); 
    //$this->sidebar1 = array_merge($teeoUserMenu->menuTree,$this->sidebar1);

    if(isset($this->breadcrumb))
      array_push($this->breadcrumb, array("lbl"=>$this->pages[Yii::app()->controller->id][Yii::app()->controller->action->id]["title"]));

    $page = $this->pages[Yii::app()->controller->id][Yii::app()->controller->action->id];
    $this->title = Yii::t("teeo",((isset($page["title"])) ? $page["title"] : $this->title),null,Yii::app()->controller->module->id);
    $this->subTitle = Yii::t("teeo",((isset($page["subTitle"])) ? $page["subTitle"] : $this->subTitle),null,Yii::app()->controller->module->id);
    $this->pageTitle = Yii::t("teeo",((isset($page["pageTitle"])) ? $page["pageTitle"] : $this->pageTitle),null,Yii::app()->controller->module->id);
    $this->projectName = Yii::t("teeo" ,$this->projectName ,null ,Yii::app()->controller->module->id);

    $this->notifications = ActivityStream::getNotifications(array("notify.id"=>Yii::app()->session["userId"]));

    CornerDev::addWorkLog("teeo","you@dev.com",Yii::app()->controller->id,Yii::app()->controller->action->id);
  }

}
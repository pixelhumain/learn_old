<?php
$cs = Yii::app()->getClientScript();

//assets from the theme
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/weather-icons/css/weather-icons.min.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js' , CClientScript::POS_END);

//assets from the ctk
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/vis.css');

//assets from the module
$cs->registerScriptFile($this->module->assetsUrl.'/js/script.js' , CClientScript::POS_END);
		
?>
<!-- start: PAGE CONTENT -->
<div class="row">

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="partition-green padding-20 text-center core-icon">
          <i class="fa fa-users fa-3x icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Association</h3>
          <span class="subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </span>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <div class=""></div>
        <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person?tabId=panel_organisations")?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="my NGOs" ><i class="fa fa-user"></i></a>
        <a href="#" onclick="openSubView($(this).attr('alt'), '/<?php echo $this->module->id?>/organization/form/type/NGO',null);" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add an NGO" alt="Add an NGO"><i class="fa fa-plus"></i></a>
        <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/organization/index/type/NGO")?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-red" data-toggle="tooltip" data-placement="top" title="all NGOs"><i class="fa fa-chevron-right"></i></a>
      </div>
    </div>
  </div>
</div>
<!-- end: PAGE CONTENT-->
<script>
  jQuery(document).ready(function() {
   
   //Index.init();
  });

</script>
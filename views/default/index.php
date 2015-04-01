<?php
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/datepicker/css/datepicker.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END);

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/dropzone/downloads/css/ph.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/dropzone/downloads/dropzone.min.js' , CClientScript::POS_END);

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/css/lightbox.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/js/lightbox.min.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<div class="row">
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-20 text-center core-icon">
          <i class="fa fa-users icon-big text-pink"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin text-pink">Learn</h3>
          <span class="subtitle">
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-20 text-center core-icon">
          <i class="fa fa-lightbulb-o icon-big text-green"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin text-green">Think</h3>
          <span class="subtitle">
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-20 text-center core-icon">
          <i class="fa fa-cogs icon-big text-azure"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin text-azure">Build</h3>
          <span class="subtitle">
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-20 text-center core-icon">
          <i class="fa fa-share-alt icon-big text-orange"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin text-orange">Share</h3>
          <span class="subtitle">
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i><br>2DO
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-wrench icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Init Data</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i><br>2DO
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-wrench icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Module Menu</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i><br>2DO
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-wrench icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Notifications</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i><br>2DO
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-wrench icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">??? </h3>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">  
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        
        <div class="padding-20">
          <h3 class="title block no-margin"><i class="fa fa-cogs fa-2x text-red"></i>Config</h3>
          <span class="subtitle"> You can control with config </span>
          <br/>
            <p>check out LearnModule.php</p>
            <p>check out components/LearnController.php</p>
            <p>sidebar1 : manages left side menu</p>
            <p>toolbarMenuAdd : manages ADD Menu Entry (TODO:show:Add)</p>
            <p>toolbarMenuMaps : manages CARTO Menu Entry (TODO:show:Carto)</p>
            <p>pages : list all available controler/action and defines </p>
            <p>initPage() : can be used for any shareed process</p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-green padding-20 text-center core-icon">
          <i class="fa fa-list-alt  icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Form Manipulation</h3>
          <span class="subtitle"> simple Form Processing  </span>
            <p>click Add > add Event </p>
            <p> <a href="#newEvent" class="btn btn-default new-event"><i class="fa fa-calendar"></i> new Event</a></p>
            <hr>
            <p> <a href="#newTodo" class="btn btn-default new-todo"><i class="fa fa-check-square"></i> todo CRUD</a></p>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <div class=""></div>
        <a href="#newEvent" class="new-event col-xs-6 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add an Event" alt="Add an Event"><i class="fa fa-plus"></i></a>
        <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/event")?>" class="col-xs-6 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="all Events"><i class="fa fa-chevron-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-heading text-bold">List of Events</div>
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-20 ">
          <table  class="table ">
            <tbody class="eventList">
            <?php foreach ($events as $key => $value) {
                echo "<tr><td>".$value["name"]."</td></tr>";
            } ?>
            </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-heading text-bold">Todo List</div>
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-20 ">
          <table  class="table ">
            <tbody class="todoList">
            <?php foreach ($todos as $key => $value) {
                echo "<tr id='todo".(string)$value["_id"]."'>".
                       "<td>".$value["name"]."</td>".
                       "<td><a href='javascript:;' data-id='".(string)$value["_id"]."' class='deleteTodo btn btn-default btn-xs text-red'><i class='fa fa-times'></i> </a></td>".
                     "</tr>";
            } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <div class=""></div>
          <a href="#newTodo" class="new-todo col-xs-6 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add a Todo" alt="Add a Todo"><i class="fa fa-plus"></i> 1</a>
          <a href="#" class="new-todyn col-xs-6 padding-10 text-center text-white tooltips partition-orange" data-toggle="tooltip" data-placement="top" title="Add a Todo" alt="Add a Todo"><i class="fa fa-plus"></i> 2</a>
        </div>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-heading text-bold">Last News</div>
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-20 newsPanel">
            <?php foreach ($lastNews as $key => $value) {
                echo  "<b class='newsTitle'>".$value["title"]."</b>".
                      "<div class='newsMsg'>".$value["msg"]."</div>".
                      "<div class='newsDate text-extra-small'>".date('d/m/Y H:i', $value["created"])."</div>";
            } ?>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <div class=""></div>
          <a href="#" class="new-news col-xs-6 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add a News" alt="Add a News"><i class="fa fa-plus"></i></a>
        </div>
    </div>
  </div>

</div>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
jQuery(document).ready(function() {
 bindIndexEvents();
});

function bindIndexEvents () { 

  $(".deleteTodo").off().on("click",function() { 
    todoId = $(this).data("id");
    deleteTodo(todoId);
    $('#todo'+todoId ).css("background-color","#FF3700").fadeOut(800, function(){
      $('#todo'+todoId ).remove();
    });
  });

  $(".new-todyn").off().on("click",function() { 
    openDynamicSubview("todoForm","todos",updateTodo);
  });

  $(".new-news").off().on("click",function() { 
    openDynamicSubview("actuForm","news",updateNewsPanel);
  });

}

 function updateEvent(nevent,eventId){
  console.log("updateEvent func");
  var eventLine  = "<tr><td>"+nevent.title+"</td></tr>";
  $(".eventList").append(eventLine);
 }

 function updateTodo(ntodo,todoId){
  console.log("updateTodo func");
  var todoLine  = "<tr id='todo"+todoId["$id"]+"'>"+
                  "<td>"+ntodo.name+"</td>"+
                  "<td><a href='javascript:;' data-id='"+todoId["$id"]+"' class='deleteTodo btn btn-xs btn-default text-red'><i class='fa fa-times'></i> </a></td>"+
                  "</tr>";
  $(".todoList").append(todoLine);
  bindIndexEvents ();
 }
function updateNewsPanel(data,id) { 
  $(".newsMsg").html(data.msg);
  $(".newsTitle").html(data.title);
  date = new Date();
  now = date.getDate() + '/' + (date.getMonth() + 1) + '/' +  date.getFullYear()+' '+((date.getHours()<10) ? "0"+date.getHours() : date.getHours())+':'+((date.getMinutes()<10) ? "0"+date.getMinutes() : date.getMinutes());
  $(".newsDate").html(now);
}
 
</script>
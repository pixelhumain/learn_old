

<div class="row">
    <div class="col-md-12 padding-20 ">
        <a href="#newEvent" class="new-event btn btn-xs btn-light-blue tooltips pull-right" data-placement="top" data-original-title="Edit"><i class="fa fa-plus"></i> Add an Event</a>
    </div>  
</div>
<div class="panel panel-white">
    <div class="panel-heading">
        List of all Events
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover" id="events">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="hidden-xs">Type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="eventList">
                <?php
                if(isset($events)){
                foreach ($events as $e) 
                {
                ?>
                <tr id="event<?php echo (string)$e["_id"];?>">
                    <td><?php if(isset($e["name"]))echo $e["name"]?></td>
                    <td><?php if(isset($e["type"]))echo $e["type"]?></td>
                    <td class="center">
                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                        <a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/event/public/id/'.$e["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
                        <a href="#" class="btn btn-red tooltips delEventBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                    </div>
                    </td>
                </tr>
                <?php
                }}
                ?>
            </tbody>
        </table>
    </div>

</div>
<script type="text/javascript">
jQuery(document).ready(function() 
{
    $('.delEventBtn').off().on("click",function()
    {
        id = $(this).data("id");
        $.blockUI({
            message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
            '<blockquote>'+
              '<p>Qui veut faire quelque chose trouve un moyen ; qui ne veut rien faire trouve une excuse..</p>'+
              '<cite title="Proverbe arabe">Proverbe arabe</cite>'+
            '</blockquote> '
        });
        $.ajax({
                type: "POST",
                url: baseUrl+"/"+moduleId+'/event/delete',
                dataType : "json",
                data:{"id":id},
                type:"POST",
            })
            .done(function (data) 
            {
                $.unblockUI();
                if (data &&  data.result) {               
                    toastr.success('Deleted successfully');
                    $('#event'+id ).css("background-color","#FF3700").fadeOut(400, function(){
                          $('#event'+id ).remove();
                    });
                } else {
                   toastr.error('Something Went Wrong');
                }
            });
    });
});

function updateEvent(nevent,eventId)
{
    console.log("updateEvent func");
    var eventLine  = '<tr id="event'+eventId+'">'+
                '<td>'+nevent.title+'</td>'+
                '<td>'+nevent.type+'</td>'+
                '<td class="center">'+
                '<div class="visible-md visible-lg hidden-sm hidden-xs">'+
                    '<a href="'+baseUrl+'/'+moduleId+'/event/public/id/'+eventId+'" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a> '+
                    '<a href="#" class="btn btn-red tooltips delEventBtn" data-id="'+eventId+'" data-name="'+nevent.title+'" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'+
                '</div>'+
                "</td>"+
            "</tr>";
    $(".eventList").append(eventLine);
}

</script>
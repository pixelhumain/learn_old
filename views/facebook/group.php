<?php
    
    /*$group_detail = Yii::app()->session["FB_group_detail"];
    print_r($group_detail);
    print_r($group);*/
?>
<div>
    <div>
        <?php
            
        ?>
        <h1><?php echo $group_detail['name'] ;?></h1>
        
        <form method="POST" action="" id="shareForm" >
            <input type="hidden" id="idgroup" value="<?php echo $group_detail['id'] ;?>"/>
            <textarea id="textFB">Bonjour venez vous aussi vous communectez</textarea>
            <a href="#" class="btn btn-primary" id="submitPartager">Partager</a>
        </form>
    </div> 
</div>

<script type="text/javascript">
jQuery(document).ready(function() 
{
     $("#submitPartager").on('click', function()
     {
        console.log("submit");
        $.ajax({
            type: 'POST',
            data: {textToRecup : $('#textFB').val() },
            url: baseUrl+'/learn/facebook/share/',
            dataType : 'json',
            success: function(data)
            {
                console.dir(data);
                if(data.result)
                    toastr.success("success");
                else
                    toastr.error("error"); 
            }
        });
    });


});
</script>
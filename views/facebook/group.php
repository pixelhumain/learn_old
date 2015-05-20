<?php
    
    $url = 'http://127.0.0.1/ph/learn/facebook/group/idgroup/'.$idgroup;
?>
<div>
    <div>
        <?php
            
        ?>
        <h1><?php echo $idgroup ;?></h1>
        <div>
           Text : <?php print_r($textFB) ;?>
        </div>
        <form method="POST" action="<?php echo $url ;?>" id="shareForm" >
            <input type="hidden" id="idgroup" value="<?php echo $idgroup ;?>"/>
            <textarea id="textFB">Bonjour venez vous aussi vous communectez</textarea>
            <button class="btn btn-primary" id="submitPartager">Partager</button>
        </form>
    </div> 
</div>

<script type="text/javascript">
jQuery(document).ready(function() 
{
    var idgroup = $('#idgroup').val();
    $.ajax({
            type: "POST",
            url: baseUrl+"/learn/facebook/group/idgroup/"+idgroup,
        });

     $("#shareForm").submit(function(e)
     {
        //e.preventDefault();
        $this = $(this);
        var textFB = $('#textFB').val();
        $.ajax({
            type: $this.attr('method'),
            data: {textToRecup : "textFB="+textFB },
            url: $this.attr('action'),
            dataType : 'json',
            success: function(data)
            {
                console.log(data);
            },
        });
    });


});
</script>

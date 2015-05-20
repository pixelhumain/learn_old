<div>
    <div >
        <?php echo $first_name. " ". $last_name ;?>
    </div> 
    <div >

    	<table border="1px">
    		<tr>
    			<th>Groupe Facebook</th>
    		</tr>
    		<?php
    			foreach($groups as $group)
				{
					echo '<tr>';
	    			echo '<td><a href="/ph/learn/facebook/group/idgroup/'.$group->id.'"> '. $group->name . '</a></td>' ;
	    			echo '</tr>';
	    		}
    		?>
    	</table>
    </div> 
</div>
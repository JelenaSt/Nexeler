<div class="page-body">

<h1>Predstave</h1>

<?php

require_once(dirname(__FILE__)."\..\..\models\Play.php");
header("Content-Type: text/html;charset=utf-8");
$plays = Play::fetchAllPlays();

if ($plays->num_rows > 0)
{
    foreach($plays as $play)
    {
        $id = $play['ID'];
        $title = $play['Title'];
		$description = $play['Description'];
        
        $picture = Play::getPlayPictureById($id);
?>

        <table style="width: 80%">
            <col width="30%">
            <col width="70%">
		<tr>
		<th><label><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $picture ).'" width="200"/>'.'<br>'; ?></label></th>
		<th><label>
		
		<h2><?php echo "$title "; ?></h2>
		<?php  
        $descShort = substr("$description",0,400);
        echo "$descShort"."...".'<br>'.'<br>' ;	
        ?>
		
		<button class="button">Detaljnije</button>
		
		<?php
        if (Session::get('user_level') == 2)
        {
        ?>
			<button class="button">Izmeni</button>
		<?php 
        } 
        ?>
		
		</label></th>
        </tr>
        </table>

 <?php 
	}
}

 ?>
</div>
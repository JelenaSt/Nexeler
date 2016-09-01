<div class="page-body" >

<?php

	header("Content-Type: text/html;charset=utf-8");
	
	$playId = Request::get('playId',true);
	$play= Play::getPlayByID($playId);
    // $playId;
    // $playTitle;
    // $description;
	
	if (!empty((array) $play))
	{
		$picture = Play::getPlayPictureById($playId);
	
?>
	<h1><?php echo $play->playTitle;?></h1>

	<table style="width: 80%">
				
		<tr><th><label><?php echo '<br>'.'<br>'.'<img src="data:image/jpeg;base64,'.base64_encode( $picture ).'" height="300"/>'.'<br>'.'<br>'.'<br>'; ?></label></th></tr>
		<tr><th><label><?php echo nl2br($play->description).'<br>'.'<br>'; ?>
	
		<?php 
			if (Session::get('user_level') == 2)
			{
		?>
		<form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/edit_play" method="post"">
			<input type="hidden" name="playId" value=<?php echo $playId ?> />
			<button class="button" style="float: right;">Izmeni</button>  
		</form>
		<?php 
			} 
		?>
			
			</label></th>
			</tr>
			</table>
	<?php
		} //if (!empty((array) $play))
	 ?>
</div>
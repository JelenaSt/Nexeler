<div class="page-body" >

<?php

	header("Content-Type: text/html;charset=utf-8");
	
	$artistId = Request::get('artistId',true);
	$artist = Artist::getArtistByID($artistId);
	
	if (!empty((array) $artist))
	{
		$picture = Artist::getArtistPictureById($artistId);
	
?>

	<h1><?php echo $artist->artistName;?></h1>

	<table style="width: 80%">
				
		<tr>
			<th><label><?php echo '<br>'.'<br>'.'<img src="data:image/jpeg;base64,'.base64_encode( $picture ).'" height="300"/>'.'<br>'.'<br>'.'<br>'; ?></label></th></tr>
		<tr><th><label><?php echo nl2br($artist->artistBiography).'<br>'.'<br>'; ?>
	
		<?php 
			if (Session::get('user_level') == 2)
			{
		?>
		<form id="play-form" action="<?php echo Config::get('ROOT'); ?>artist/edit" method="post"">
			<input type="hidden" name="artistId" value=<?php echo $artistId ?> />
			<button class="button" style="float:left;">Izmeni</button>  
		</form>
		<?php 
			} 
		?>
			
			</label></th>
			</tr>
			</table>
	<?php
		} //if (!empty((array) $artist))
	 ?>
</div>
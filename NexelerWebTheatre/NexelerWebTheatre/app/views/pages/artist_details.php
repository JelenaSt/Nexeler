<div class="page-body">

	<?php header("Content-Type: text/html;charset=utf-8");?>

	<h1><?php echo $data['artist']->artistName;?></h1>

	<?php $picture = Artist::getArtistPictureById($data['artist']->artistId);?>
	
	<table style="width: 80%">		
		<tr><th><label><?php echo '<br>'.'<br>'.'<img src="data:image/jpeg;base64,'.base64_encode( $picture ).'" height="300"/>'.'<br>'.'<br>'.'<br>'; ?></label></th></tr>
		<tr><th><label><?php echo nl2br($data['artist']->artistBiography).'<br>'.'<br>'; ?>
		<?php 
			if (Session::get('user_level') == 2)
			{?>
				<form id="play-form" action="<?php echo Config::get('ROOT'); ?>artist/edit" method="post"">
					<input type="hidden" name="artistId" value=<?php echo $data['artist']->artistId ?> />
					<button class="button" style="float:left;">Izmeni</button>  
				</form>
			<?php 
			}?>
		</label></th></tr>
	</table>
</div>
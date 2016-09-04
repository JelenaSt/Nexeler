<div class="page-body">

	<h1>Umetnička postava</h1>

	<?php
	if (Session::get('user_level') == 2)
	{
	?>
		<td>
			<form id="artist-form" action="<?php echo Config::get('ROOT'); ?>artist/create_new" method="link">
				<button class="button" style="float: right;">Dodaj novo</button>  
			</form>
		</td>
		<?php 
	} 

	header("Content-Type: text/html;charset=utf-8");
	
	if (!empty($data['artists']))
	{
		foreach($data['artists'] as $artist)
		{
			$artistId = $artist['ID'];
			$name = $artist['Name'];
			$biography = $artist['Biography'];
			$picture = Artist::getArtistPictureById($artistId);
		?>
			<table style="width: 80%">
				<col width="30%">
				<col width="70%">
				
				<tr>
					<th><label><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $picture ).'" width="200"/>'.'<br>'; ?></label></th>
					<th><label><h2><?php echo "$name "; ?></h2>
						<?php  
						if (strlen($biography) < 400)
						{
							echo "$biography".'<br>'.'<br>' ;
						}
						else
						{
							$bioShort = substr("$biography",0,400);
							echo "$bioShort"."...".'<br>'.'<br>';
						}?>
					</label></th>
				</tr>
				<tr>
					<td></td>
					<td>
						<form id="artist-form" action="<?php echo Config::get('ROOT'); ?>artist/artistpage" method="get"">
							<input type="hidden" name="artistId" value=<?php echo $artistId ;?> />
							<button class="button" style="float: left;">Detaljnije</button>  
						</form>
					<?php
					if (Session::get('user_level') == 2)
					{?>
						<form id="artist-form" action="<?php echo Config::get('ROOT'); ?>artist/edit" method="post"">
							<input type="hidden" name="artistId" value=<?php echo $artistId ;?> />
							<button class="button" style="float:left;">Izmeni</button>  
						</form>
							
						<form id="artist-form" action="<?php echo Config::get('ROOT'); ?>artist/remove" method="post"">
							<input type="hidden" name="artistId" value=<?php echo $artistId ;?> />
							<button class="button" style="float: left;">Obri&#154;i</button>  
						</form>
					<?php 
					}?>
					</td>
				</tr>
			</table>
		<?php 
		}
	}
	
	if ($data['totalPages'] > 0)
	{
		$urlForPages = Config::get('ROOT')."home/artists";
		
		echo '<br>'.'<br>';
		for ($i=1; $i<=$data['totalPages']; $i++) 
		{ 
			echo "<a href=".$urlForPages."?page=".$i."'>".$i."</a> "; 	
		}; 
	}

	?>
</div>

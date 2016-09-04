<div class="page-body container" style="padding:5px; margin:auto;">

	<h1>Predstave</h1>

	<?php
	if (Session::get('user_level') == 2)
	{
	?>
		<td>
			<form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/create_new" method="link">
				<button class="button" style="float: right;">Dodaj novo</button>  
			</form>
		</td>
		<?php 
	} 

	header("Content-Type: text/html;charset=utf-8");
	
	if (!empty($data['plays']))
	{
		foreach($data['plays'] as $play)
		{
			$playId = $play['ID'];
			$title = $play['Title'];
			$description = $play['Description'];
			$picture = Play::getPlayPictureById($playId);
		?>
			<table style="width: 80%">
				<col width="30%">
				<col width="70%">
				
				<tr>
					<th><label><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $picture ).'" width="200"/>'.'<br>'; ?></label></th>
					<th><label><h2><?php echo "$title "; ?></h2>
						<?php  
						if (strlen($description) < 400)
						{				
							echo "$description".'<br>'.'<br>';	
						}
						else
						{
							$descShort = substr("$description",0,400);
							echo "$descShort"."...".'<br>'.'<br>' ;	
						}?>
					</label></th>
				</tr>
				<tr>
					<td></td>
					<td>
						<form  action="<?php echo Config::get('ROOT'); ?>play/plays_page" method="get"">
							<input type="hidden" name="playId" value=<?php echo $playId ?> />
							<button class="button"style="float: left;">Detaljnije</button>  
						</form>
					<?php
					if (Session::get('user_level') == 2)
					{?>
						<form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/edit" method="post"">
							<input type="hidden" name="playId" value=<?php echo $playId ?> />
							<button class="button" style="float:left;">Izmeni</button>  
						</form>
						<form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/remove" method="post"">
							<input type="hidden" name="playId" value=<?php echo $playId ?> />
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
		$urlForPages = Config::get('ROOT')."home/preformances";
		
		echo '<br>'.'<br>';
		for ($i=1; $i<=$data['totalPages']; $i++) 
		{ 
			echo "<a href=".$urlForPages."?page=".$i."'>".$i."</a> "; 	
		}; 
	}
	
	
	
	
	?>
</div>
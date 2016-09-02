<div class="page-body" style="height:auto">

<h1>Predstave</h1>

<?php
if (Session::get('user_level') == 2)
{
?>
	<td>
		<form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/create_new_play" method="link">
			<button class="button" style="float: right;">Dodaj novo</button>  
		</form>
	</td>
	<?php 
} 

header("Content-Type: text/html;charset=utf-8");
$plays = Play::fetchAllPlays();

if ($plays->num_rows > 0)
{
    foreach($plays as $play)
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
					<th>
						<label>
							<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $picture ).'" width="200"/>'.'<br>'; ?>
						</label>
					</th>
					
					<th>
						<label>
							<h2><?php echo "$title "; ?></h2>
							<?php  
        $descShort = substr("$description",0,400);
        echo "$descShort"."...".'<br>'.'<br>' ;	
                            ?>
						</label>
					</th>
				</tr>
				
				<tr>
					<td></td>
					<td>
						<form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/plays_page" method="get"">
							<input type="hidden" name="playId" value=<?php echo $playId ?> />
							<button class="button"style="float: left;">Detaljnije</button>  
						</form>
					
					<?php
        if (Session::get('user_level') == 2)
        {
                    ?>
						<form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/edit_play" method="post"">
							<input type="hidden" name="playId" value=<?php echo $playId ?> />
							<button class="button" style="float:left;">Izmeni</button>  
						</form>
						
						<form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/delete_play" method="post"">
							<input type="hidden" name="playId" value=<?php echo $playId ?> />
							<button class="button" style="float: left;">Obriši</button>  
						</form>
						
					
					<?php 
        } 
                    ?>
					</td>
				</tr>
			</table>

	<?php 
    }
}

    ?>
</div>
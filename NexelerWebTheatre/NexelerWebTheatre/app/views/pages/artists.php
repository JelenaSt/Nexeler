<div class="page-body">

<h1>Umetnička postava</h1>

<?php
require_once(dirname(__FILE__)."\..\..\models\Artist.php");
header("Content-Type: text/html;charset=utf-8");
$artists = Artist::fetchAllArtist();

if ($artists->num_rows > 0)
{
    foreach($artists as $artist)
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
		<th><label>
		
		<h2><?php echo "$name "; ?></h2>
		<?php  
        $bioShort = substr("$biography",0,400);
        echo "$bioShort"."...".'<br>'.'<br>' ;	
		
		$redirect = Config::get('ROOT');
		$redirect .= 'artist/artistpage';

    ?>
		<form id="artists-form" action="<?php echo Config::get('ROOT'); ?>artist/artistpage" method="get"">
			<input type="hidden" name="artistId" value=<?php echo $artistId ?> />
            <button class="button">Detaljnije</button>  
        </form>
		
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
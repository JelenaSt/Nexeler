<div class="page-body" style="height:100%">
    <h1>Informacije o umetniku</h1>
    <br/>

    <form  action="<?php echo Config::get('ROOT'); ?>artist/update" method="post" enctype="multipart/form-data">
        <input type="hidden" name="artistId" value="<?php echo $data['artist']->artistId; ?>"/>
        <table style="width: 80%">
            <col width="30%">
            <col width="70%">
            <tr>
                <th><label>Ime:</label></th>
                <td><input type="text" name="name" value="<?php echo $data['artist']->artistName;?>"/></td>
            </tr>
            <tr>
                <th><label>Biografija:</label></th>
                <td><textarea name="biography" rows="10" cols="80"><?php echo $data['artist']->artistBiography; ?></textarea></td>
            </tr>
            <tr>
			<tr>
				<th><label>Slika:</label></th>
				<td><input type="file" name="file"></td>
			</tr>
			
                <th><button class="cancel-button" formaction="<?php echo Config::get('ROOT').'home/artists';?>">Odustani</button></th>
                <td><button class="button">Promeni podatke</button></td>
            </tr>

        </table>

    </form>
</div>

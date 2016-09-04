<div class="page-body" style="height:100%">
    <h1>Informacije o predstavi</h1>
    <br/>

    <form  action="<?php echo Config::get('ROOT');?> play/create_new_play" method="post" enctype="multipart/form-data">
        <table style="width: 80%">
            <col width="30%">
            <col width="70%">
            <tr>
                <th><label>Naslov:</label></th>
                <td><input type="text" name="title" /></td>
            </tr>
            <tr>
                <th><label>Opis predstave:</label></th>
                <td><textarea name="description" rows="10" cols="80"></textarea></td>
            </tr>
            <tr>
			<tr>
				<th><label>Slika:</label></th>
				<td><input type="file" name="file"></td>
			</tr>
			
                <th><button class="cancel-button" formaction="<?php echo Config::get('ROOT').'home/preformances';?>" >Odustani</button></th>
                <td><button class="button">Sačuvaj</button></td>
            </tr>

        </table>

    </form>
</div>

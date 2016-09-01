<div class="page-body" style="height:100%">
    <h1>Informacije o predstavi</h1>
    <br/>

    <form  action="<?php echo Config::get('ROOT'); ?>play/play_update" method="post">
        <input type="hidden" name="playId" value="<?php echo $data['play']->playId; ?>"/>
        <table style="width: 80%">
            <col width="30%">
            <col width="70%">
            <tr>
                <th><label>Naslov:</label></th>
                <td><input type="text" name="title" value="<?php echo $data['play']->playTitle; ?>"/></td>
            </tr>
            <tr>
                <th><label>Opis predstave:</label></th>
                <td><textarea  name="description" rows="10" cols="80"> <?php echo $data['play']->description; ?></textarea></td>
            </tr>
            <tr>
                <th><button class="cancel-button" formaction="<?php echo Config::get('ROOT') . 'home/preformances';?>" >Odustani</button></th>
                <td><button class="button">Promeni podatke</button></td>
            </tr>

        </table>

    </form>
</div>

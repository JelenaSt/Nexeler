<script type="text/javascript" src="<?php echo Config::get('ROOT'); ?>js/reservation.js"></script> 
<script type="text/javascript" src="<?php echo Config::get('URL'); ?>public/jquery/jquery-timepicker/jquery.timepicker.min.js"></script>
<link type="text/css" href="<?php echo Config::get('URL'); ?>public/jquery/jquery-timepicker/jquery.timepicker.css" rel="stylesheet" />

<?php
$halls = $data['halls'];
$plays = $data['plays'];
?>
<div class="page-body" style="height:100%">
    <h1>Unesite informacije o projekciji</h1>
    <br/>

    <form  action="<?php echo Config::get('ROOT'); ?>event/newevent" method="post" enctype="multipart/form-data">
        <table style="width: 80%">
            <col width="30%">
            <col width="70%">
            <tr>
                <th><label>Naslov:</label></th>
                <td><input type="text" name="event_name"/></td>
            </tr>
            <tr>
                <th><label>Datum:</label></th>
                  <td> <input id="date" name="date"/></td>
            </tr>
            <tr>
                <th><label>Vreme:</label></th>
                <td><input id="time" name="time"/></td>
                
            </tr>
            <tr>
			<tr>
				<th><label>Sala:</label></th>
				<td>
                    <select name="hall_data">
                        <?php
                        foreach($halls as $hall){
                        ?>
                        <option value="<?php echo $hall['hall_id']?>"><?php echo $hall['hall_name']?></option>
                        <?php 
                        } ?>
                    </select>

				</td>
			</tr>
                <tr>
				<th><label>Predstava:</label></th>
				<td>
                    <select name="play_data">
                        <?php
                        foreach($plays as $play){
                        ?>
                            <option value="<?php echo $play['ID']?>" selected><?php echo $play['Title']?></option>
                            <?php } ?>
                    </select>

                </td>
			</tr>
                <th><button class="cancel-button" formaction="<?php echo Config::get('ROOT') . 'event/eventspage';?>" >Odustani</button></th>
                <td><button class="button">Unesi</button></td>
            </tr>
        </table>

    </form>
</div>

<script>
    $("#date").datepicker({ 'dateFormat': 'yy-mm-dd' });

    $('#time').timepicker({ 'timeFormat': 'H:i' });
    //$(function () {
    //    $('#time').dtpicker();
    //});
</script>
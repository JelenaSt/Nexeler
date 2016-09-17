
<script type="text/javascript" src="<?php echo Config::get('URL'); ?>public/jquery/jquery-timepicker/jquery.timepicker.min.js"></script>
<link type="text/css" href="<?php echo Config::get('URL'); ?>public/jquery/jquery-timepicker/jquery.timepicker.css" rel="stylesheet" />

<?php
$event = $data['event'];
$halls = $data['halls'];
$plays = $data['plays'];
?>
<div class="page-body" style="height:100%">
    <h1>Informacije o projekciji</h1>
   
    <br/>

    <form  action="<?php echo Config::get('ROOT'); ?>event/update" method="post" enctype="multipart/form-data">
        <input type="hidden" name="eventID" value="<?php echo $event->eventId; ?>"/>
        <table style="width: 80%">
            <col width="30%">
            <col width="70%">
            <tr>
                <th><label>Naslov:</label></th>
                <td><input type="text" name="event_name" style="width:232px;" value="<?php echo $event->eventName; ?>"/></td>
            </tr>
  <!--          <tr>
                <th><label>Vreme predstave:</label></th>
                <td><input type="datetime" name="event_time" value="<?php echo $event->event_time; ?>" /></td>
            </tr>-->
            <tr>
                <th><label>Datum:</label></th>
                <td> 
                    <input id="date" name="test_date" value="<?php echo $event->date; ?>"/>
                   <!-- <input id="time" name="test_time"  value="<?php echo $event->time; ?>"/>-->
                </td>
            </tr>
            <tr>
                <th><label>Vreme:</label></th>
                <td> 
                    <input id="time" name="test_time"  value="<?php echo $event->time; ?>"/>
                </td>
            </tr>
			<tr>
				<th><label>Sala:</label></th>
				<td>
                    <select name="hall_data" style="width:232px;">
                        <?php
                        foreach($halls as $hall){
                            $hall_id = $hall['hall_id'];
                            $selected = ($hall['hall_id'] == $event->hall_id) ? true : false;
                            if($selected){
                            ?>
                                <option value="<?php echo $hall['hall_id']?>" selected><?php echo $hall['hall_name']?></option>
                            <?php 
                            }else{
                            ?>
                                <option value="<?php echo $hall['hall_id']?>"><?php echo $hall['hall_name']?></option>
                            <?php }
                        } ?>
                    </select>

				</td>
			</tr>
                <tr>
				<th><label>Predstava:</label></th>
				<td>
                    <select name="play_data" style="width:232px;">
                        <?php
                        foreach($plays as $play){
                            $play_id = $play['ID'];
                            $selected = ($play_id  == $event->play_id) ? true : false;
                            if($selected){
                            ?>
                            <option value="<?php echo $play['ID']?>" selected><?php echo $play['Title']?></option>
                            <?php
                            }else{
                            ?>
                            <option value="<?php echo $play['ID']?>" ><?php echo $play['Title']?></option>
                            <?php }
                            } ?>
                    </select>

                </td>
			</tr>
                <th><button class="cancel-button" formaction="<?php echo Config::get('ROOT') . 'event/eventspage';?>" >Odustani</button></th>
                <td><button class="button">Promeni podatke</button></td>
            </tr>
        </table>

    </form>
</div>

<script>
    $("#date").datepicker({ 'dateFormat': 'yy-mm-dd' });

    $('#time').timepicker({ 'timeFormat': 'H:i' });

</script>
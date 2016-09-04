
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
                <td><input type="text" name="event_name" value="<?php echo $event->eventName; ?>"/></td>
            </tr>
            <tr>
                <th><label>Vreme predstave:</label></th>
                <td><input type="datetime" name="event_time" value="<?php echo $event->event_time; ?>" /></td>
            </tr>
            <tr>
			<tr>
				<th><label>Sala:</label></th>
				<td>
                    <select name="hall_data">
                        <?php
                        foreach($halls as $hall){?>
                            <option value="<?php echo $hall['hall_id']?>"><?php echo $hall['hall_name']?></option>
                        <?php } ?>
                    </select>

				</td>
			</tr>
                <tr>
				<th><label>Predstava:</label></th>
				<td>
                    <select name="play_data">
                        <?php
                        foreach($plays as $play){?>
                            <option value="<?php echo $play['ID']?>"><?php echo $play['Title']?></option>
                        <?php } ?>
                    </select>

				</td>
			</tr>
			
                <th><button class="cancel-button" formaction="<?php echo Config::get('ROOT') . 'home/events';?>" >Odustani</button></th>
                <td><button class="button">Promeni podatke</button></td>
            </tr>

        </table>

    </form>
</div>
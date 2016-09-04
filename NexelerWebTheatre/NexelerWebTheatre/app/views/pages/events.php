
<div class="w3-container" style="margin:20px; padding-bottom:20px;">
  
 <div  style="text-align:left; width:50%; float:left;" >
   <h2>Repertoar</h2>
              <table style="width:90%">

            <?php 
            $users = $data['events'];


            //for ($row = 0; $row < 3; $row++)
            //{
            //    echo $users[$row]["event"]." play ".$users[$row]["play"]." and pic id ".$users[$row]["play_picture"];
            //    echo "<br />";
            //}



            print_r($users);
            foreach ($users as $key => $value) {
            //   $eventDate = new DateTime($value['event_time']);
            //   $eventDate = $eventDate->format("F j, Y, g:i");
            
            ?>
            <!--<tr>
                <td><?php echo $value['eventID']; ?></td>
                <td><?php echo $value['event_name']; ?></td>
                <td><?php echo $eventDate ?></td>
                <td><button class="button">Detaljnije</button></td>
            </tr>-->
            <?php } ?>
        </table>
    </div>
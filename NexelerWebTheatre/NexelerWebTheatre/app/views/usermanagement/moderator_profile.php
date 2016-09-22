<script type="text/javascript" src="<?php echo Config::get('ROOT'); ?>js/moderator.js"></script>
<script type="text/javascript" src="<?php echo Config::get('ROOT'); ?>js/reservation.js"></script>
<script type="text/javascript" src="<?php echo Config::get('URL'); ?>public/jquery/jquery-timepicker/jquery.timepicker.min.js"></script>
<link type="text/css" href="<?php echo Config::get('URL'); ?>public/jquery/jquery-timepicker/jquery.timepicker.css" rel="stylesheet" />

<div class="page-body" style="height:auto">
<h1>Moderator profil</h1>
    <div>
      <form  id="filter" style="margin:20px auto 20px auto; width:90%; max-width: 100%;"  action="<?php echo Config::get('ROOT'); ?>moderator/filter" method="post">
          <h3>Forma za filtriranje rezervacija</h3>
          
           <table>
              <tr>
                  <th>Naziv predstave</th>
                  <td><input id="playName" type="text" name="playName"/></td>
                  <th>Datum projekcije</th>
                  <td> <input id="datum" type="text" name="datum"/></td>
              </tr>
              <tr>
                  <th>Ime/Prezime korsinika</th>
                  <td><input id="nameUser" type="text" name="nameUser"/></td>
                  <th>Id korisnika</th>
                  <td><input id="idUser" type="text" name="idUser"/></td>
              </tr>
              <tr>
                  <td colspan="2" align="center">
                        <input type="submit" class="button" style="float: left;" value="FILTRIRAJ"/>
                  </td>
              </tr>
          </table>
           <!-- <input id="eventID" type="text" name="eventID"/-->
            
           
           
        </form>
         <!--<button class="button" style="float: left;" onclick="filterReservations()">FILTRIRAJ</button>-->
     </div>
    <div style="margin: 20px auto; width:100%">
        <label id="result-status"></label>
        
      
        
        <table id="all_reservations" style="text-align:center; margin: 20px auto; width:100%">
            <col width="10%">
            <col width="30%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
            
            <tr>
                <th>Id rezervacije</th>
                <th>Naziv predstave</th>
                <th>Datum</th>
                <th>Vreme</th>
                <th>Id korisnika</th>
                <th>Ime korisnika</th>
                <th>Broj rez.karata</th>
            </tr>
        <?php
        $reservations = $data['reservations'];
        $no_reservations = (count($reservations) === 0) ? false : true;
        
        if($no_reservations){
            foreach($reservations as $reservation){
                $event = Projection::getEventByID($reservation['event_id']);
                $user=User::getUserById($reservation['user_id']);
                $no_reservations = true;
        ?>
             <tr>
                 <td><?php echo $reservation['reservationID']?></td>
                 <td><?php echo $event->eventName?></td>
                 <td><?php echo $event->date?></td>
                 <td><?php echo substr($event->time,0,5)?>h</td>
                 <td><?php echo $user->userID ?></td>
                 <td><?php echo $user->name .'&nbsp'. $user->last_name ?></td>
                 <td><?php echo $reservation['num_of_cards']?></td>
                 <td>
                     <button id="deleteButton" class="button-small" style="float: left;" onclick="OnDeleteButton(<?php echo $reservation['reservationID']?>)">Otkazi</button>
                     
                 </td>
             </tr>
          <?php } 
            }  
        if(!$no_reservations){
          ?>
            <tr>
                <td colspan="7" align="center">"Trenutno nema aktivnih rezervacija u bazi podataka za ovog korisnika!!"</td>
            </tr>
        <?php   
        }?>
             </table>
        <!--echo 'Trenutno nema aktivnih rezervacija u bazi podataka za ovog korisnika!! ';-->
    </div>

</div>


<div id="reserve-delete-confirm" style="display:none;">
  <div><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
      Molimo Vas  potvrdite otkazivanje rezervacije!
      <form  id="del_reservation" action="<?php echo Config::get('ROOT'); ?>reservation/delete">
          <input id="reservationID" type="hidden" name="reservationID" value=""/>
          <!--<button class="button button-small">Otkazi rezervaciju</button>-->
      </form>
      
  </div>
</div>

<script>
    $("#datum").datepicker({ 'dateFormat': 'yy-mm-dd' });
</script>
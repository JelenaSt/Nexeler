<script type="text/javascript" src="<?php echo Config::get('ROOT'); ?>js/moderator.js"></script>

<div class="page-body">
<h1>Moderator profil</h1>
    <div style="margin: 20px auto; width:100%">
      <form  id="filter"  action="<?php echo Config::get('ROOT'); ?>moderator/filter" method="post">
            <input id="eventID" type="text" name="eventID"/>
        </form>
         <button class="button" style="float: left;" onclick="filterReservations()">FILTRIRAJ</button>
     </div>
    <div style="margin: 20px auto; width:100%">
        <label id="result-status"></label>
        
      
        <label><?php echo $data['type'];?></label>
        <table id="all_reservations" style="text-align:center">
            <col width="10%">
            <col width="30%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
            
            <tr>
                <th>Id</th>
                <th>Naziv predstave</th>
                <th>Datum</th>
                <th>Vreme</th>
                <th>Id korisnika</th>
                <th>Ime korisnika</th>
                <th>Broj rez.karata</th>
            </tr>
        <?php
        $reservations = $data['reservations'];
        $no_reservations = false;
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
          <?php }   ?>
             </table>
        <?php
        if(!$no_reservations){
            echo 'Trenutno nema aktivnih rezervacija u bazi podataka za ovog korisnika!! ';
        }
        ?>
    </div>

</div>
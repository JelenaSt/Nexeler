
<?php if(Session::errorFeedbackExists()):?>
<div class="message">
    <?php echo  Session::getErrorFeedback();?>
</div>
<?php endif;?>
<?php if(Session::infoFeedbackExists()):?>
<div class="message" style="text-align: center;">
    <?php echo  Session::getInfoFeedback();?>
</div>
<?php endif;?>

<div class="page-body" style="height:100%">
    <h1>Korisnicki profil</h1><br />

    <form  action="<?php echo Config::get('ROOT'); ?>profile/editprofile" method="get">
       
    <table style="width: 80%">
                <col width="30%">
                <col width="70%">
     
                <tr>
                    <th><label>Ime:</label></th>
                    <td><label><?php echo $data['user']->name; ?></label></td>
                </tr>
                <tr>
                    <th><label>Prezime:</label></th>
                    <td><label><?php echo $data['user']->last_name;; ?></label></td>
                </tr>
                <tr>
                    <th><label>Korisnicko ime:</label></th>
                   <td><label><?php echo $data['user']->username; ?></label></td>
                </tr>
                <tr>
                    <th><label>E-mail:</label></th>
                   <td><label><?php echo $data['user']->email; ?></label></td>
                </tr>
                <tr>
                    <th><label>Sifra:</label></th>
                   <td><label>**********</label></td>
                </tr>
                <tr>
                    <th><label>Korisnicki profil:</label></th>
                   <td><label><?php echo $data['user']->user_type; ?></label></td>
                </tr>
                <tr>
                    <th></th>
                   <td><button class="button">Promeni podatke</button></td>
                </tr>
               
            </table>
         </form>

    <div style="margin: 20px auto;">
        <table style="text-align:center">
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
                <th>Broj rez.karata</th>
            </tr>
        <?php
        $reservations = $data['reservations'];
        $no_reservations = false;
        foreach($reservations as $reservation){
            $event = Projection::getEventByID($reservation['event_id']);
            $no_reservations = true;
        ?>
             <tr>
                 <td><?php echo $reservation['reservationID']?></td>
                 <td><?php echo $event->eventName?></td>
                 <td><?php echo $event->date?></td>
                  <td><?php echo substr($event->time,0,5)?>h</td>
                  <td><?php echo $reservation['num_of_cards']?></td>
                 <td>
                     <form  action="<?php echo Config::get('ROOT'); ?>reservation/delete" method="get">
                           <input type="hidden" name="reservationID" value="<?php echo $reservation['reservationID']?>"/>
                         <button class="button button-small">Otkazi rezervaciju</button>
                     </form>
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

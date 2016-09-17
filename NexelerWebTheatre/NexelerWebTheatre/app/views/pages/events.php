<script type="text/javascript" src="<?php echo Config::get('ROOT'); ?>js/reservation.js"></script>


<div class="page-body container" style="padding:5px; margin:auto;">
    <h1>Repertoar</h1>
   
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

    <div style="width:100%; height:80px;">
        <?php if(Session::get('user_level') == MODERATOR_LEVEL):?>
        <form action="<?php echo Config::get('ROOT'); ?>event/addnew" method="post">
            <button class="button" style="float: right;">Dodaj novi</button>
        </form>
        <?php elseif(Session::userIsLoggedIn()):?>
        <p>
             Aktuelni repertoar NexelerWeb pozorišta. 
             Ukoliko želite rezervisati karte za neku od predstava na repertoaru potrebno je da izaberete opciju
             "Rezervisi" koja se nalazi pored prikaza svake od predstava na repertoaru.
             Nakon što Vam se prikaze dialog, izaberite broj karata koji želite da rezervišite i potvrdite Vaš izbor
            pritiskom na dugme "Potvrdi". Ukoliko imate poteško?a sa rezervacijom, možete nas kontaktirati putem emaila
            ili kontak telefona.
   	   </p>
         <?php else:?>
       <p> Dobrodošli na repertoar Nexeler WebPozorišta. Da biste bili u mogu?nosti da iskoristite
        nas online servis za rezervaciju karata molimo vas da se registrujete. 
           </p>
        <?php endif; ?>
        </div>
     
     <ul id="events_list">
            <?php 
            $events = $data['events'];
            $event_cnt = $data['events_cnt'];

            for($i = 0; $i < $event_cnt; $i++){
               
			    if (empty($events[$i])) continue;
                $event = $events[$i];
                $event_date = new DateTime($event['date'] . ' ' . $event['time'] );
                $event_date = $event_date->format('d.m, Y, H:i');
                $playId = $event['play_id'];
                $play = Play::getPlayByID($playId);
                $hall_name = Hall::getHallNameByID($event['hall_id']);
                $picture = Play::getPlayPictureById($playId);
              
            ?>
                 <li>
                     <table>
                         <tr>
                            <td>
                                <label><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $picture ).'" width="200"/>'.'<br>'; ?></label>
                            </td>
                             <td>
                                 <table>
                                     <tr>
                                         <td>
                                             <h2>
                                            <?php 
                                            echo $event['event_name'];
                                            ?>
                                                 </h2>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td><?php echo $event_date . 'h';?></td>
                                     </tr>
                                     <tr>
                                       <td><?php echo 'Sala : &nbsp' . $hall_name ?> </td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <form  action="<?php echo Config::get('ROOT'); ?>play/plays_page" method="get"">
                                                 <input type="hidden" name="playId" value=<?php echo $playId ?> />
                                                 <button class="button" style="float: left;">O predstavi</button>
                                             </form>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>
                                               <?php if(Session::get('user_level') == USER_LEVEL):?>
                                              <button id="reserveButton" class="button" style="float: left;" onclick="OnReserveButton(<?php echo $event['eventID'] ?>)">REZERVISI</button>
                                             <?php endif;?>
                                             <?php if(Session::get('user_level') == MODERATOR_LEVEL):?>
                                             <form action="<?php echo Config::get('ROOT'); ?>event/edit" method="get">
                                                 <input type="hidden" name="eventID" value="<?php echo $event['eventID'] ?>" />
                                                 <button type="submit" class="button button-small" style="float: left;">IZMENI</button>
                                             </form>
                                              <button class="button button-small" style="float: left; margin-left:10px;"   onclick="OpenConfirmationDialog(<?php echo $event['eventID'] . ',\'' . $event['event_name'] . '\'' ?>)">Obrisi</button>

                                            <?php endif; ?>
                                         </td>
                                     </tr>
                                 </table>
                               
                             </td>
                         </tr>
                        
                     </table>
                 </li>
             
             <?php }; ?>
          </ul>
		    
 </div>
 <div class="page-body container" style="padding:10px; margin: auto;">
 <?php 
	if ($data['totalPages'] > 0)
	{
		$urlForPages = Config::get('ROOT')."home/events";
		$curr_page = $data['curr_page'];
		echo '<br>'.'<br>';
		for ($i=1; $i<=$data['totalPages']; $i++) 
		{ 
            if($curr_page == $i){
                echo '<a class="page_num" href='.$urlForPages.'?page='.$i.'><strong>'.$i.'</strong></a>'; 
            }else{
                echo '<a class="page_num" href='.$urlForPages.'?page='.$i.'><sup>'.$i.'</sup></a>';  
            }
				
		}; 
	}
 ?>	
 </div>

<div id="reserveDialog" style="display:none;">
    Rezervišite karte za vašu predstavu:
    <form id="reservation-form" action="<?php echo Config::get('ROOT'); ?>reservation/addReservation" method="post"><!--  action="<?php echo Config::get('ROOT'); ?>reservation/addReservation" method="post"-->
        <input id="event_id" type="hidden" name="event_id" value=""/><br />
        <select id="num_of_cards" name="num_of_cards" style="width:100%">
            <option value="1" selected>1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
            <option value="4" >4</option>
            <option value="5" >5</option>
        </select>
        <label id="result-status"></label>
        <button id="reserve_tickets_btn" style="float: left;"  class="button" >REZERVISI</button> 
    </form>
</div>

<div id="event-delete-confirm" style="display:none;">
  <div><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
      Molimo Vas  potvrdite brisanje projekcije <label id="del_event_name"></label>
      sa repertoara!
      
      <form id="del_event" action="<?php echo Config::get('ROOT'); ?>event/delete" method="get">
          <input id="eventID" type="hidden" name="eventID" value="" />
      </form>
  </div>
</div>
       


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
        <form action="<?php echo Config::get('ROOT'); ?>event/addnew" method="post"">
            <button class="button" style="float: right;">Dodaj novi</button>
        </form>
        <?php endif; ?>
        </div>
     <ul>
            <?php 
            $events = $data['events'];
            $event_cnt = $data['events_cnt'];

            for($i = 0; $i < $event_cnt; $i++){
               
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
                                             <form id="play-form" action="<?php echo Config::get('ROOT'); ?>play/edit" method="post"">
                                                 <input type="hidden" name="playId" value=<?php echo $playId ?> /><br />
                                                 
                                                 <input type="text" name="numofcards" placeholder="Broj karata:"  />
                                                 <button class="button" style="float: left;">REZERVISI</button>
                                             </form>
                                             <?php endif;?>
                                             <?php if(Session::get('user_level') == MODERATOR_LEVEL):?>
                                             <form action="<?php echo Config::get('ROOT'); ?>event/edit" method="get">
                                                 <input type="hidden" name="eventID" value="<?php echo $event['eventID'] ?>" />
                                                 <button class="button" style="float: left;">IZMENI</button>
                                             </form>
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

       
<div class="page-body">
<div class="w3-container" style="height:100%">
   <div>

        <?php if(Session::errorFeedbackExists()):?>
            <div class="message">
            <?php echo  Session::getErrorFeedback();?>
            </div>
        <?php endif;?> 
          <?php if(Session::infoFeedbackExists()):?>
            <div class="message" style="text-align:center;">
            <?php echo  Session::getInfoFeedback();?>
            </div>
        <?php endif;?>  

   <div style="width:48%; float:left; margin:5px; padding:5px;" >
   <h2>Admin profil</h2>
             <form  action="<?php echo Config::get('ROOT'); ?>profile/editprofile" method="get">
            <table>

                <tr>
                    <th><label>Ime:</label></th>
                    <td><label><?php echo $data['admin']->name; ?></label></td>
                </tr>
                <tr>
                    <th><label>Prezime:</label></th>
                    <td><label><?php echo $data['admin']->last_name;; ?></label></td>
                </tr>
                <tr>
                    <th><label>Korisnicko ime:</label></th>
                    <td><label><?php echo $data['admin']->username; ?></label></td>
                </tr>
                <tr>
                    <th><label>E-mail:</label></th>
                    <td><label><?php echo $data['admin']->email; ?></label></td>
                </tr>
                <tr>
                    <th><label>Sifra:</label></th>
                    <td><label>**********</label></td>
                </tr>
                <tr>
                    <th><label>Korisnicki profil:</label></th>
                    <td><label><?php echo $data['admin']->user_type; ?></label></td>
                </tr>
                <tr>
                    <th></th>
                    <td><button class="button">Promeni podatke</button></td>
                </tr>
            </table>
        </form>
  
    </div>
    <div style="width:48%; height:246px; float:right; padding:5px;">
    <h2>Statistika</h2>
        <table>
       
            <tr>
                <td>Moderatori</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Registrovani korisnici:</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Ulogovani korisnici:</td>
                <td>2</td>
            </tr>
        </table>
   </div>
</div>


<div class="w3-container" style="margin:20px; padding-bottom:20px;">
  
 <div  style="text-align:left; width:50%; float:left;" >
   <h2>Registrovani korisnici</h2>
              <table style="width:90%">
            <tr>
                <td>Id</td>
                <td>Ime</td>
                <td>Prezime</td>
                <td>Koris.ime</td>
            </tr>
            <?php 
            $users = $data['users'];
            foreach ($users as $key => $value) {
                $promoteUrl = Config::get('ROOT') . 'admin/promote/' . $value['userID'];
                $deleteUrl = Config::get('ROOT') . 'admin/deleteuser/' . $value['userID'];
            ?>
            <tr>
                <td><?php echo $value['userID']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['last_name']; ?></td>
                <td><?php echo $value['username']; ?></td>
               <!-- <td><button class="button-small" onclick="<?php Redirect::to($promoteUrl); ?>">unapredi</button></td>-->
                <td><a href="<?php echo $promoteUrl?>" class="button-small btn btn-default ">Unapredi</a></td>
                <td><a href="<?php echo $deleteUrl?>" class="button-small btn btn-default ">Obrisi</a></td>
                <!--<td><button class="button-small" onclick="<?php Redirect::to($deleteUrl); ?>">obrisi</button></td>-->
            </tr>
            <?php } ?>
        </table>
    </div>
    <div  style="width:50%; float:right;">
    <h2>Moderatori</h2>
        <table style="width:90%">
            <tr>
                <td>Id</td>
                <td>Ime</td>
                <td>Prezime</td>
                <td>Koris.Ime</td>
            </tr>
                <?php 
                $moderators = $data['moderators'];
                foreach ($moderators as $key => $value) {
                     $suspendUrl = Config::get('ROOT') . 'admin/downgrade/' . $value['userID'];
                     $deleteUrl = Config::get('ROOT') . 'admin/deleteuser/' . $value['userID'];
                ?>
                <tr>
                    <td><?php echo $value['userID']; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['last_name']; ?></td>
                    <td><?php echo $value['username']; ?></td>
                    <td><a href="<?php echo $suspendUrl?>" class="button-small btn btn-default ">Suspenduj</a></td>
                    <td><a href="<?php echo $deleteUrl?>" class="button-small btn btn-default ">Obrisi</a></td>
                </tr>
                <?php } ?>
        </table>
   </div>
</div>

</div>
</div>

  <?php if(Session::infoFeedbackExists()):?>
            <div class="message" style="text-align:center;">
            <?php echo  Session::getInfoFeedback();?>
            </div>
        <?php endif;?>  

<div class="page-body">
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
</div>
<div class="page-body" style="height:100%">
    <h1>Korisnicki profil</h1>
    <br />

    <form  action="<?php echo Config::get('ROOT'); ?>profile/edituser" method="post">
        <input type="hidden" name="userID" value="<?php echo $data['user']->userID; ?>"/>
        <table style="width: 80%">
            <col width="30%">
            <col width="70%">
            <tr>
                <th><label>Ime:</label></th>
                <td><input type="text" name="name" value="<?php echo $data['user']->name; ?>"/></td>
            </tr>
            <tr>
                <th><label>Prezime:</label></th>
                <td><input type="text" name="last_name" value="<?php echo $data['user']->last_name; ?>"/></td>
            </tr>
            <tr>
                <th><label>Korisnicko ime:</label></th>
                <td><input type="text" readonly name="user_name" value="<?php echo $data['user']->username; ?>"/></td>
            </tr>
            <tr>
                <th><label>E-mail:</label></th>
                <td><input type="text" name="email" value="<?php echo $data['user']->email; ?>"/></td>
            </tr>
            <tr>
                <th><label>Sifra:</label></th>
                <td><input type="password" name="password" placeholder="password" /></td>
            </tr>
            <tr>
                <th><label>Sifra:</label></th>
                <td><input type="password" name="password_repeat" placeholder="password" /></td>
            </tr>
            <tr>
                <th><label>Korisnicki profil:</label></th>
                <td><input type="text" name="user_type" readonly value="<?php echo $data['user']->user_type; ?>" /></td>
            </tr>
            <tr>
                <th><button class="cancel-button" formaction="<?php echo Config::get('ROOT') . 'profile/profilepage'?>" >Odustani</button></th>
                <td><button class="button">Promeni podatke</button></td>
            </tr>

        </table>

    </form>

    <?php if(Session::errorFeedbackExists()):?>
            <div class="message">
            <?php echo  Session::getErrorFeedback();?>
            </div>
        <?php endif;?> 
</div>

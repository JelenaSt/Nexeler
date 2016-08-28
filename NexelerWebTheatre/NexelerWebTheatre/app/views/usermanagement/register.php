
<div>
<div class="page">
        <form class="page-form" action="<?php echo Config::get('ROOT'); ?>register/register" method="post">
            <h1>Registracija korisnika</h1>
            <br/>
            <table style="width: 100%">
                <col width="30%">
                <col width="70%">
                <tr>
                    <td><label>Ime</label></td>
                    <td><input type="text" name="name" placeholder="Ime"/></td>
                </tr>
                <tr>
                    <td><label>Prezime</label></td>
                    <td><input type="text" name="last_name" placeholder="Last name"/></td>
                </tr>
                <tr>
                    <td><label>Korisnicko ime</label></td>
                    <td><input type="text" name="user_name" placeholder="Username" /></td>
                </tr>
                <tr>
                    <td><label>E-mail</label></td>
                    <td><input type="text" name="email" placeholder="example@example.com" /></td>
                </tr>
                <tr>
                    <td><label>Sifra</label></td>
                    <td><input type="password" name="password" placeholder="password" /></td>
                </tr>
                 <tr>
                    <td><label>Ponovite sifru</label></td>
                    <td><input type="password" name="password_repeat" placeholder="password" /></td>
                </tr>

            </table>
            <button id="login_button">Posalji zahtev</button> 
        </form>

         <?php if(Session::errorFeedbackExists()):?>
            <div class="message">
            <?php echo  Session::getErrorFeedback();?>
            </div>
        <?php endif;?>  
    </div>

</div>
    


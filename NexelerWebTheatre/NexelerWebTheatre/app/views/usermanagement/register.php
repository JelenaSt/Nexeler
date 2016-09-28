
<script type="text/javascript" src="<?php echo Config::get('ROOT'); ?>js/registration.js"></script>
<?php  header("Content-Type: text/html;charset=utf-8"); ?>
<div>
<div class="page">
      
    <?php if(Session::errorFeedbackExists()):?>
            <div id="errorMessage" class="message">
            <?php echo  Session::getErrorFeedback();?>
            </div>
        <?php endif;?>  

      
        <form id="register_form" class="page-form" action="<?php echo Config::get('ROOT'); ?>register/register" method="post">
            <h1>Registracija korisnika</h1>
            <br/>
            <table style="width: 100%">
                <col width="30%">
                <col width="70%">
                <tr>
                    <td><label>Ime</label></td>
                    <td><input type="text" id="name" name="name" placeholder="Ime"/></td>
                </tr>
                <tr>
                    <td><label>Prezime</label></td>
                    <td><input type="text" id="last_name" name="last_name" placeholder="Prezime"/></td>
                </tr>
                <tr>
                    <td><label>Korisničko ime</label></td>
                    <td>
                       <!-- <div class="container"></div>-->
                            <input type="text" id="user_name" name="user_name" placeholder="Korisni?ko ime" onBlur="checkAvailability()" style="width:70%"/>
                            <IMG id='user-availability-status' style='display: none;'>
                    </td>
                </tr>
                
                <tr>
                    <td><label>E-mail</label></td>
                    <td><input type="text" id="email" name="email" placeholder="example@example.com" /></td>
                </tr>
                <tr>
                    <td><label>Šifra</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Šifra" /></td>
                </tr>
                 <tr>
                    <td><label>Ponovite šifru</label></td>
                    <td><input type="password" id="password_repeat" name="password_repeat" placeholder="Šifra" /></td>
                </tr>
                <!--<tr><td></td> <td> <label id="user-availability-status"></label></td></tr>-->
            </table>
             
            <label id="validation-status"></label>
            <!--<input type="button" name="login_button" id="login_button" value="Pošalji zahtev">-->
           <button id="login_button">Pošalji zahtev</button>
        </form>

       
    </div>

</div>
    


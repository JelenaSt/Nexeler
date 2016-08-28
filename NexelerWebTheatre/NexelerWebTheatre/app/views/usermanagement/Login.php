
    <div id="login-page">
        <form id="login-form" action="<?php echo Config::get('ROOT'); ?>login/login" method="post"">
            <input type="text" name="user_name" placeholder="username" />
            <input type="password" name="password" placeholder="password" />
            <button id="login_button">Uloguj se</button>
            <div class="link-forgot-my-password">
                <a href="<?php echo Config::get('URL'); ?>login/requestPasswordReset">I forgot my password</a>
            </div>
        </form>
        

         
        <?php 
        $warrnign = Session::get('warrning_message');
        if(isset($warrnign)):
        ?>
        <div class="message">
            <?php 
            echo  $warrnign;
            Session::set('warrning_message', null);
            endif;
            ?>  
         </div>
    </div>

   

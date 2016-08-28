
        <?php if(Session::infoFeedbackExists()):?>
            <div class="message" style="text-align:center;">
            <?php echo  Session::getInfoFeedback();?>
            </div>
        <?php endif;?>  

    <div id="login-page">
        <form id="login-form" action="<?php echo Config::get('ROOT'); ?>login/login" method="post"">
            <input type="text" name="user_name" placeholder="username" />
            <input type="password" name="password" placeholder="password" />
            <button id="login_button">Uloguj se</button>
            <div class="link-forgot-my-password">
                <a href="<?php echo Config::get('URL'); ?>login/requestPasswordReset">I forgot my password</a>
            </div>
        </form>
        
        <?php if(Session::errorFeedbackExists()):?>
            <div class="message">
            <?php echo  Session::getErrorFeedback();?>
            </div>
        <?php endif;?>  
         
    </div>

   

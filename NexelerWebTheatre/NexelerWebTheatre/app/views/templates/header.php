
<!DOCTYPE html>
<html>
    
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="<?php echo Config::get('URL'); ?>public/jquery/jquery-ui-1.12.1/external/jquery/jquery.js"></script>s
    <script src="<?php echo Config::get('URL'); ?>public/jquery/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>public/jquery/jquery-ui-1.12.1/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>public/css/style.css" type="text/css" />
	<title>NEXELER Theatre</title>
</head>
<body>

<?php
/*Just for your server-side code*/
header('Content-Type: text/html; charset=utf-8');

?>
    <div id="header">
      

        <div id="menu">
            <div id="menu_list"> 
                <a href="<?php echo Config::get('ROOT'); ?>home/index">Pocetna</a>
                <img src="../../public/images/splitter.gif" class="splitter" alt="" />
                <a href="<?php echo Config::get('ROOT'); ?>home/events">Repertoar</a>
                <img src="../../public/images/splitter.gif" class="splitter" alt="" />
                <a href="<?php echo Config::get('ROOT'); ?>home/preformances">Predstave</a>
                <img src="../../public/images/splitter.gif" class="splitter" alt="" />
                <a href="<?php echo Config::get('ROOT'); ?>home/artists">Umetnici</a>
                <img src="../../public/images/splitter.gif" class="splitter" alt="" />
                <a href="<?php echo Config::get('ROOT'); ?>contact/info">Kontakt</a>
            </div>
        </div>
     
    </div>


    <div id="logo">
      <div id="slogan"><strong>Web</strong>Pozoriste</div>
      <div id="logo_text">
            <a href="#">Nexeler</a>
            <br/><br/>
            Dobrodošli na web prezentaciju Nexeler pozorišta.
	    </div>
        <div id="guest">
            <?php if(Session::userIsLoggedIn()):?>
                      
            <div>
                <label>WELCOME <strong><?php echo  '  ' . Session::get('name') ?></strong></label>
                <div><a href="<?php echo Config::get('ROOT'); ?>login/logout">Odjavi se</a></div>
            </div>
             <div>
                <?php if(Session::get('user_level') == ADMIN_LEVEL):?>
                <a href="<?php echo Config::get('ROOT'); ?>admin/adminpage">AdminPanel</a>
                <?php elseif(Session::get('user_level') == MODERATOR_LEVEL):?>
                <a href="<?php echo Config::get('ROOT'); ?>moderator/moderatorpage">Moderator Panel</a>
                <?php elseif(Session::get('user_level') == USER_LEVEL):?>
                <a href="<?php echo Config::get('ROOT'); ?>profile/profilepage">Korisnicki Profil</a>
                <?php endif;?>
             </div>
            <?php else :?>
            <a href="<?php echo Config::get('ROOT'); ?>login/loginpage">Prijavi se</a>
            <a style="color:black;" href="<?php echo Config::get('ROOT'); ?>register/registerpage">Registruj se</a>
            <?php endif;?>
        </div>
   
    </div>

     
    
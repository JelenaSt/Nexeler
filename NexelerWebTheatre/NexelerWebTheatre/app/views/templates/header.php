
<!DOCTYPE html>
<html>
    
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>public/css/style.css" type="text/css" />
	<title>NEXELER Theatre</title>
</head>
<body>
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
                <a href="<?php echo Config::get('ROOT'); ?>home/contact">Kontakt</a>
            </div>
        </div>
     
    </div>


    <div id="logo">
      <div id="slogan"><strong>Web</strong>Pozoriste</div>
      <div id="logo_text">
            <a href="#">Nexeler</a>
            <br/><br/>
            Dobrodosli na web prezentaciju Nexeler pozorista.
	    </div>
        <div id="guest">
            <?php if(Session::userIsLoggedIn()):
                       if(Session::get('user_level') == ADMIN_LEVEL):?>
            <a href="#">AdminPanel</a>
            <?php elseif(Session::get('user_level') == MODERATOR_LEVEL):?>
            <a href="#">Moderator Panel</a>
            <?php elseif(Session::get('user_level') == USER_LEVEL):?>
            <a href="#">User Panel</a>USER <?php echo Session::get('username'); ?>
            <?php endif;?>
            <a href="<?php echo Config::get('ROOT'); ?>login/logout">LOGOUT</a>
            <?php else :?>
            <a href="<?php echo Config::get('ROOT'); ?>login/loginpage">LOGIN</a>
            <a href="<?php echo Config::get('ROOT'); ?>login/logout">Register</a>
            <?php endif;?>

        </div>
   
    </div>

     
    
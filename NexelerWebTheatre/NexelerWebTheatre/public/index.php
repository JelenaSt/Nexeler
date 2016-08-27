<?php

require_once '../app/init.php';

$app = new App();

include "../app/views/templates/header.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
    <div class="login">
      <form name="loginForm" method="post" action="authorize.php">
          <font color="#FFFFFF">E-mail </font><input name="email" type="text"/>
          <font color="#FFFFFF">Password </font><input name="password" type="password"/>
          <input type="submit" value=" Log In"/>
      </form>
      </div>
</body>
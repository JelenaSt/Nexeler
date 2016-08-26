<?php

require_once '../app/init.php';
echo 'HTTP HOST:' . $_SERVER['HTTP_HOST'] . PHP_EOL;
echo 'HTTP HOST:' . $_SERVER['SERVER_NAME'] . PHP_EOL;

$app = new App();

?>

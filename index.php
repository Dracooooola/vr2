<?php

require_once 'vendor/autoload.php';
require_once 'confing.php';
use Base\Application as Application;
session_start();
//use App\Main\Controller\Controller as Controller;
//if (class_exists(App\Main\Controller\Controller::class)){
//    echo 'boom';
//} else {
//    echo 'ggwp';
//}
//$kek = new Controller();
$app = new Application(DATABASE);
$app->run();

//echo '\\';

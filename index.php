<?php

// phpinfo();

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL); 

/** composer */
include_once __DIR__ .'/vendor/autoload.php';

/** run app */
use App\App;
$app = new App();
$app->show();
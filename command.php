<?php


/** composer */
include_once __DIR__ .'/vendor/autoload.php';

use App\CMS\Build\Build;

$comand = $argv[1];

switch($comand){
    case 'build':
        Build::build();
        break;
    default:
}

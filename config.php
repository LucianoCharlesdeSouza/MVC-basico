<?php

require 'environment.php';

global $config;
$config = array();

if (ENVIRONMENT == 'development') {
    define("BASE", "http://localhost/MVC-basico/");
    define("BASEADMIN", "http://localhost/MVC-basico/painel/");
    $config['dbname'] = 'grupo++';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    define("BASE", "");
    define("BASEADMIN", "");
    $config['dbname'] = 'dbname';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'user';
    $config['dbpass'] = 'pass';
}


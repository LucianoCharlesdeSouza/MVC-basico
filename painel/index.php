<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

foreach (glob('../system/Functions/*.php') as $file) {
    include_once $file;
};

spl_autoload_register(function ($class) {

    if (file_exists('controllers/' . $class . '.php')) {
        require_once 'controllers/' . $class . '.php';
    } elseif (file_exists('models/' . $class . '.php')) {
        require_once 'models/' . $class . '.php';
    } elseif (file_exists('repository/' . $class . '.php')) {
        require_once 'repository/' . $class . '.php';
    } elseif (file_exists('../models/' . $class . '.php')) {
        require_once '../models/' . $class . '.php';
    } elseif (file_exists('../core/' . $class . '.php')) {
        require_once '../core/' . $class . '.php';
    } elseif (file_exists('../system/Classes/' . $class . '.php')) {
        require_once '../system/Classes/' . $class . '.php';
    } elseif (file_exists('../system/Library/' . $class . '.php')) {
        require_once '../system/Library/' . $class . '.php';
    } elseif (file_exists('../system/Library/Mailer/' . $class . '.php')) {
        require_once '../system/Library/Mailer/' . $class . '.php';
    }
});

$core = new Core();
$core->run();


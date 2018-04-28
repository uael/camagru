<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(__DIR__) . DS);
define('REWRITE_URL', false);

session_start();
date_default_timezone_set('Europe/Paris');

// GLOBALS
define('PUBLIC_PATH', ROOT . 'public' . DS);
define('APP_PATH', ROOT . 'app' . DS);
define('VIEW_PATH', APP_PATH . 'view' . DS);
define('CONFIG_PATH', ROOT . 'config' . DS);

require ROOT . 'public' . DS . 'index.php';

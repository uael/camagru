<?php
require_once APP_PATH . DS . 'Camagru' . DS . 'Autoloader.php';
\Camagru\Autoloader::register();

print_r(\Camagru\Model\User::all());

<?php
require_once APP_PATH . DS . 'Camagru' . DS . 'Autoloader.php';
\Camagru\Autoloader::register();

$user = new \Camagru\Model\User([
	"username" => "clecle",
	"email" => "clecle@gmail.com",
	"password" => "cle",
	"confirmed" => true
]);
$user->save();
print_r(\Camagru\Model\User::all());

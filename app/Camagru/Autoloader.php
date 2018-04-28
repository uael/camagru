<?php
namespace Camagru;

class Autoloader {
	public static function register() {
		spl_autoload_register([__CLASS__, 'autoload']);
	}

	public static function autoload($class) {
		$parts = preg_split('#\\\#', $class);
		$className = array_pop($parts);

		$path = implode(DS, $parts);
		$file = $className . '.php';
		$filepath = APP_PATH . $path . DS . $file;

		require $filepath;
	}
}

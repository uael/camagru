<?php

namespace Camagru;

abstract class Controller {

	public static function dispatch($action, array $params) {
		if (method_exists(static::class, $action)) {
			static::$action($params);
		} elseif (strlen($action) == 0
			&& method_exists(static::class, "index")) {
			static::index($params);
		} else {
			echo \Camagru\View::render(VIEW_PATH.'404.php', []);
		}
	}
}

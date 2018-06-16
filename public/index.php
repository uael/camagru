<?php
require_once APP_PATH . DS . 'Camagru' . DS . 'Autoloader.php';
\Camagru\Autoloader::register();

$_SESSION["couleur"] = "is-danger";

try {
	if (!($url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH))
		|| strlen($url) == 0) {
		unset($_SESSION['message']);
		\Camagru\Controller\Home::index();
		return;
	}

	$parts = preg_split('/[^a-z]+/', $url);
	if (count($parts) > 3) {
		echo \Camagru\View::render(VIEW_PATH.'404.php', []);
		return;
	}

	switch ($parts[1]) {
		case "":
			if (isset($parts[2])) {
				echo \Camagru\View::render(VIEW_PATH.'404.php', []);
				return;
			}
			unset($_SESSION['message']);
			\Camagru\Controller\Home::index(); return;
		case "login":
			if (isset($parts[2])) {
				echo \Camagru\View::render(VIEW_PATH.'404.php', []);
				return;
			}
			\Camagru\Controller\Home::login(); return;
		case "logout":
			if (isset($parts[2])) {
				echo \Camagru\View::render(VIEW_PATH.'404.php', []);
				return;
			}
			\Camagru\Controller\Home::logout(); return;
		case "signup":
			if (isset($parts[2])) {
				echo \Camagru\View::render(VIEW_PATH.'404.php', []);
				return;
			}
			\Camagru\Controller\Home::signup(); return;
		case "reset":
			if (isset($parts[2])) {
				echo \Camagru\View::render(VIEW_PATH.'404.php', []);
				return;
			}
			\Camagru\Controller\Home::reset($_GET); return;
		case "gallery":
			if (isset($parts[2])) {
				echo \Camagru\View::render(VIEW_PATH.'404.php', []);
				return;
			}
			\Camagru\Controller\Home::gallery(); return;
		case "user": {
			if (!isset($parts[2])) {
				\Camagru\Controller\User::index();
				return;
			}
			switch ($parts[2]) {
				case "login":
					\Camagru\Controller\User::login($_POST); return;
				case "signup":
					\Camagru\Controller\User::signup($_POST); return;
				case "confirm":
					\Camagru\Controller\User::confirm($_GET); return;
				case "reset":
					\Camagru\Controller\User::reset($_POST); return;
				case "password":
					\Camagru\Controller\User::password($_POST); return;
				case "email":
					\Camagru\Controller\User::email($_POST); return;
				case "username":
					\Camagru\Controller\User::username($_POST); return;
			}
			echo \Camagru\View::render(VIEW_PATH.'404.php', []);
			return;
		}
		case "picture": {
			if (!isset($parts[2])) {
				\Camagru\Controller\Picture::index();
				return;
			}
			switch ($parts[2]) {
				case "save":
					\Camagru\Controller\Picture::save($_POST); return;
				case "delete":
					\Camagru\Controller\Picture::delete($_POST); return;
				case "upload":
					\Camagru\Controller\Picture::upload($_POST); return;
				case "mount":
					\Camagru\Controller\Picture::mount($_POST); return;
				case "like":
					\Camagru\Controller\Picture::like($_POST); return;
				case "comment":
					\Camagru\Controller\Picture::comment($_POST); return;
			}
			echo \Camagru\View::render(VIEW_PATH.'404.php', []);
			return;
		}
	}

	echo \Camagru\View::render(VIEW_PATH.'404.php', []);

} catch (\Exception $e) {
	\Camagru\Controller\Home::index();
}
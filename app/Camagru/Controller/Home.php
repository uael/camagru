<?php
namespace Camagru\Controller;

class Home extends \Camagru\Controller {

	public static function index() {
		echo \Camagru\View::render(\Camagru\View::$HOME, [
			"pictures" => \Camagru\Model\Picture::all()
		]);
	}

	public static function login() {
		echo \Camagru\View::render(\Camagru\View::$LOGIN, []);
	}

	public static function logout() {
		session_destroy();
		session_start();
		header("Location: ".\Camagru\Router::$HOME);
	}

	public static function signup() {
		echo \Camagru\View::render(\Camagru\View::$SIGNUP, []);
	}

	public static function reset(array $params) {
		if (array_key_exists("hash", $params)) {
			echo \Camagru\View::render(\Camagru\View::$RESET, [
				"hash" => $params["hash"]
			]);
		} else {
			header("Location: ".\Camagru\Router::$HOME);
		}
	}

	public static function gallery() {
		echo \Camagru\View::render(\Camagru\View::$GALLERY, [
			"pictures" => \Camagru\Model\Picture::all()
		]);
	}
}

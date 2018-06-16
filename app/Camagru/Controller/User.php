<?php

namespace Camagru\Controller;

class User {

	public static function index() {
		echo \Camagru\View::render(\Camagru\View::$USER, []);
	}

	public static function login(array $params) {
		if (array_key_exists("forgotten_pwd", $params)) {
			$user = \Camagru\Model\User::find("username", $params["username"]);
			if (!$user) {
				$_SESSION["message"] = "Unknown user ".$params["username"].".";
			} else {
				$mail = new \Camagru\Model\Mail\ForgottenPwd(
					$user->getEmail(),
					$user->getPassword()
				);
				$mail->send();
				$_SESSION["message"] = "an email to reset your password has been sent";
			}
		} elseif (\Camagru\Model\User::login($params['username'], $params['password'])) {
			$_SESSION['login'] = $params["username"];
			header("Location: ".\Camagru\Router::$HOME);
			return;
		} else {
			$_SESSION["message"] = "login failed, either wrong credentials or account not confirmed";
		}
		header("Location: ".\Camagru\Router::$LOGIN);
	}

	public static function signup(array $params) {
		if (array_key_exists("register", $params)) {
			unset($params["register"]);
		}
		$params["confirmed"] = "0";
		if (\Camagru\Model\User::exists($params)) {
			$_SESSION["message"] = "Username or email already exists. please try again";
			echo \Camagru\View::render(\Camagru\View::$SIGNUP);
		} else {
			if (isset($params["password"]))
				$params["password"] = hash("sha512", "bite${params['password']}");
			$user = new \Camagru\Model\User($params);
			$user->save();
			$confirmation_mail = new \Camagru\Model\Mail\Confirmation(
				$params["email"], $params["username"]
			);
			$confirmation_mail->send();
			$_SESSION["message"] = "A confirmation email has been set to your address. please confirm";
			echo \Camagru\View::render(\Camagru\View::$HOME, [
				"pictures" =>  \Camagru\Model\Picture::all()
			]);
		}
	}

	public static function confirm(array $params) {
		if (array_key_exists("username", $params)) {
			$user = \Camagru\Model\User::find("username", $params["username"]);
			if (!is_null($user)) {
				$user->setConfirmed(true);
				$user->save();
				$_SESSION["message"] = "Your account is confirmed, you can now login";
			} else {
				$_SESSION["message"] = "Username not found. please contact someone";
			}
			echo \Camagru\View::render(\Camagru\View::$LOGIN);
		} else {
			header("Location: ".\Camagru\Router::$HOME);
		}
	}

	public static function reset(array $params) {
		if (array_key_exists("hash", $params) && array_key_exists("new_pwd", $params)) {
			$user = \Camagru\Model\User::find("password", $params["hash"]);
			$user->setPassword(hash("sha512", "bite${params['new_pwd']}"));
			$user->save();
			$_SESSION["message"] = "Your password has been changed, you can now login";

		}
		header("Location: ".\Camagru\Router::$LOGIN);
	}

	public static function password(array $params) {
		if (key_exists("login", $_SESSION)) {
			$user = \Camagru\Model\User::find("username", $_SESSION["login"]);
			$user->setPassword(hash("sha512", "bite${params['new_pwd']}"));
			$user->save();
			$_SESSION["message"] = "Your password has been changed";

		} else {
			$_SESSION["message"] = "You are not logged in";
		}
		header("Location: ".\Camagru\Router::$USER);
	}

	public static function email(array $params) {
		if (key_exists("login", $_SESSION)) {
			$user = \Camagru\Model\User::find("username", $_SESSION["login"]);
			$user->setEmail($params["new_email"]);
			$user->save();
			$_SESSION["message"] = "Your email has been changed";

		} else {
			$_SESSION["message"] = "You are not logged in";
		}
		header("Location: ".\Camagru\Router::$USER);
	}

	public static function username(array $params) {
		if (key_exists("login", $_SESSION)) {
			$user = \Camagru\Model\User::find("username", $_SESSION["login"]);
			$user->setUsername($params["new_username"]);
			$user->save();
			$_SESSION["message"] = "Your username has been changed";

		} else {
			$_SESSION["message"] = "You are not logged in";
		}
		header("Location: ".\Camagru\Router::$USER);
	}
}

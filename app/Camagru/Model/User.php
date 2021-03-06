<?php
namespace Camagru\Model;

/**
 * Class User
 * @package Camagru
 */
class User extends \Camagru\Model {

	/**
	 * @var string
	 */
	protected $username;

	/**
	 * @var string
	 */
    protected $email;

	/**
	 * @var string
	 */
    protected $password;

	/**
	 * @var bool
	 */
    protected $confirmed;

	/**
	 * @var bool
	 */
    protected $notified;

	/**
	 * @var string
	 */
    protected $token;

	/**
	 * @var \DateTime
	 */
    protected $expiration_date;

	/**
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @return bool
	 */
	public function isConfirmed() {
		return $this->confirmed;
	}

	/**
	 * @param bool $confirmed
	 */
	public function setConfirmed($confirmed) {
		$this->confirmed = $confirmed;
	}

	/**
	 * @return bool
	 */
	public function isNotified() {
		return $this->notified;
	}

	/**
	 * @param bool $notified
	 */
	public function setNotified($notified) {
		$this->notified = $notified;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @param string $token
	 */
	public function setToken($token) {
		$this->token = $token;
	}

	/**
	 * @return \DateTime
	 */
	public function getExpirationDate() {
		return $this->expiration_date;
	}

	/**
	 * @param \DateTime $expiration_date
	 */
	public function setExpirationDate($expiration_date) {
		$this->expiration_date = $expiration_date;
	}

	/**
	 * @param $username
	 * @param $password
	 * @return bool
	 */
	public static function login($username, $password) {
		if (($user = self::find("username", $username))) {
			if ($user->isConfirmed()) {
				return $user->getPassword() === hash("sha512", "bite$password");
			}
		}
		return false;
	}

	/**
	 * @param array $params
	 * @return bool
	 */
	public static function exists(array $params) {
		if (array_key_exists("username", $params)) {
			if (self::find("username", $params["username"])) {
				return true;
			}
		}
		if (array_key_exists("email", $params)) {
			if (self::find("email", $params["email"])) {
				return true;
			}
		}
		return false;
	}
}

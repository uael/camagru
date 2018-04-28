<?php
namespace Camagru\Model;

use Camagru\Model;

/**
 * Class User
 * @package Camagru
 */
class User extends Model {

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var bool
	 */
	private $confirmed;

	/**
	 * @var string
	 */
	private $token;

	/**
	 * @var \DateTime
	 */
	private $expiration_date;

	/**
	 * User constructor.
	 * @param array $data
	 */
	public function __construct(array $data) {

	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

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
}

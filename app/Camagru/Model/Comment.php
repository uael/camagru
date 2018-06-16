<?php

namespace Camagru\Model;

class Comment extends \Camagru\Model {

	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * @var int
	 */
	protected $picture_id;

	/**
	 * @var string
	 */
	protected $data;

	/**
	 * @return \Camagru\Model\User
	 */
	public function getUser() {
		return \Camagru\Model\User::find("id", $this->user_id);
	}

	/**
	 * @return \Camagru\Model\Picture
	 */
	public function getPicture() {
		return \Camagru\Model\Picture::find("id", $this->picture_id);
	}

	/**
	 * @return int
	 */
	public function getUserId() {
		return $this->user_id;
	}

	/**
	 * @param int $user_id
	 */
	public function setUserId($user_id) {
		$this->user_id = $user_id;
	}

	/**
	 * @return int
	 */
	public function getPictureId() {
		return $this->picture_id;
	}

	/**
	 * @param int $picture_id
	 */
	public function setPictureId($picture_id) {
		$this->picture_id = $picture_id;
	}

	/**
	 * @return string
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @param string $data
	 */
	public function setData($data) {
		$this->data = $data;
	}
}
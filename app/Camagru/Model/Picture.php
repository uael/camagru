<?php
namespace Camagru\Model;

class Picture extends \Camagru\Model {

	/**
	 * @var string
	 */
	protected $filename;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * @return \Camagru\Model\User
	 */
	public function getUser() {
		return \Camagru\Model\User::find("id", $this->user_id);
	}

	/**
	 * @return \Camagru\Model\Like[]
	 */
	public function getLikes() {
		return \Camagru\Model\Like::where("picture_id", $this->getId());
	}

	/**
	 * @return \Camagru\Model\Comment[]
	 */
	public function getComments() {
		return \Camagru\Model\Comment::where("picture_id", $this->getId());
	}

	/**
	 * @return string
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 * @param string $filename
	 */
	public function setFilename($filename) {
		$this->filename = $filename;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getUserId() {
		return $this->user_id;
	}

	/**
	 * @param string $user_id
	 */
	public function setUserId($user_id) {
		$this->user_id = $user_id;
	}
}

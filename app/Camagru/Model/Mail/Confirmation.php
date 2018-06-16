<?php

namespace Camagru\Model\Mail;

class Confirmation extends \Camagru\Mail {

	/**
	 * @var string
	 */
	private $_subject;

	/**
	 * @var string
	 */
	private $_message;

	/**
	 * Confirmation constructor.
	 * @param $to
	 * @param $username
	 */
	public function __construct($to, $username) {
		parent::__construct($to);
		$this->_subject = "Camagru: Please confirm your account";
		$this->_message = <<<HTML
<html>
	<body>
		Welcome on Camagru,<br/>
		Please confirm your registration: <br/>
		<a href='http://localhost:8080/user/confirm?username={$username}'>
			confirm
		</a>
		<form action='http://localhost:8080/user/confirm?username={$username}'>
			<input type='submit' name='confirm'>
		</form>
	</body>
</html>
HTML;
	}

	/**
	 * @return string
	 */
	protected function getSubject() {
		return $this->_subject;
	}

	/**
	 * @return string
	 */
	protected function getMessage() {
		return $this->_message;
	}
}

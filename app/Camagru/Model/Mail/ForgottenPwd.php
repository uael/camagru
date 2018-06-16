<?php

namespace Camagru\Model\Mail;

class ForgottenPwd extends \Camagru\Mail {

	/**
	 * @var string
	 */
	private $_subject;

	/**
	 * @var string
	 */
	private $_message;

	/**
	 * ForgottenPwd constructor.
	 * @param $to
	 * @param $h_pwd
	 */
	public function __construct($to, $h_pwd) {
		parent::__construct($to);
		$this->_subject = "Camagru: Mot de passe oublié ?";
		$this->_message = <<<HTML
<html>
	<body>Please follow this url to reset you password:<br/>
		<a href='http://localhost:8080/reset?hash={$h_pwd}'>
			reset
		</a>
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

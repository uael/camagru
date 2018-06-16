<?php

namespace Camagru\Model\Mail;

class Notif extends \Camagru\Mail {

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
	 */
	public function __construct($to) {
		parent::__construct($to);
		$this->_subject = "Camagru: Someone commented your picture";
		$this->_message = <<<HTML
<html>
	<body>
		Hey someone just commented your picture, you should see it
		<a href='http://localhost:8080/gallery'>the gallery</a>
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

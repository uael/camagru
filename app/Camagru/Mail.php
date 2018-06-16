<?php
namespace Camagru;

abstract class Mail {

	protected $headers = "From: camagru@camagru.com \r\nReply-To: camagru@camagru.com \r\n";

	function __construct($to) {
		$this->to = $to;
		$this->headers .= 'MIME-Version: 1.0' . "\r\n";
		$this->headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	}

	public function send() {
		mail($this->to, $this->getSubject(), $this->getMessage(),
			$this->headers);
	}

	protected abstract function getSubject();
	protected abstract function getMessage();
}
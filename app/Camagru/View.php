<?php

namespace Camagru;

class View {

	public static $NOT_FOUND = VIEW_PATH."404.php";
	public static $USER = VIEW_PATH."user.php";
	public static $FOOTER = VIEW_PATH."footer.php";
	public static $GALLERY = VIEW_PATH."gallery.php";
	public static $HEADER = VIEW_PATH."header.php";
	public static $HOME = VIEW_PATH."home.php";
	public static $INDEX = VIEW_PATH."home.php";
	public static $LOGIN = VIEW_PATH."login.php";
	public static $PICTURE = VIEW_PATH."picture.php";
	public static $PICTURES = VIEW_PATH."pictures.php";
	public static $RESET = VIEW_PATH."reset.php";
	public static $SIGNUP = VIEW_PATH."signup.php";

	public static function render($file, $variables = []) {
		extract($variables);
		ob_start();
		include $file;
		$rendered_view = ob_get_clean();
		return $rendered_view;
	}
}
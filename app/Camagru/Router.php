<?php

namespace Camagru;

class Router {

	public static $HOME = "/";
	public static $LOGIN = "/login";
	public static $LOGOUT = "/logout";
	public static $SIGNUP = "/signup";
	public static $RESET = "/reset";
	public static $GALLERY = "/gallery";

	public static $USER = "/user";
	public static $USER_LOGIN = "/user/login";
	public static $USER_SIGNUP = "/user/signup";
	public static $USER_CONFIRM = "/user/confirm";
	public static $USER_RESET = "/user/reset";
	public static $USER_USERNAME = "/user/username";
	public static $USER_EMAIL = "/user/email";
	public static $USER_PASSWORD = "/user/password";

	public static $PICTURE = "/picture";
	public static $PICTURE_SAVE = "/picture/save";
	public static $PICTURE_DELETE = "/picture/delete";
	public static $PICTURE_UPLOAD = "/picture/upload";
	public static $PICTURE_MOUNT = "/picture/mount";
	public static $PICTURE_LIKE = "/picture/like";
	public static $PICTURE_COMMENT = "/picture/comment";
}
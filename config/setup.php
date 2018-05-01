<?php
require_once __DIR__ . '/../app/Camagru/Db.php';

if (!defined('CONFIG_PATH'))
	define('CONFIG_PATH', __DIR__ . '/');

chdir(CONFIG_PATH . '..');

use \Camagru\Db;

try {
	Db::query(
		"CREATE TABLE user(
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			username VARCHAR(255) UNIQUE NOT NULL,
			email VARCHAR(255) UNIQUE NOT NULL,
			password VARCHAR(255) NOT NULL,
			confirmed BOOLEAN DEFAULT 0,
			token VARCHAR(255),
			expiration_date DATE);"
	);
	Db::query(
		"CREATE TABLE picture(
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			filename TEXT NOT NULL,
			name TEXT NOT NULL,
			type VARCHAR(255) NOT NULL,
			user_id INTEGER NOT NULL,
			FOREIGN KEY(user_id) REFERENCES user(id));"
	);
	Db::query(
		"CREATE TABLE like(
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			user_id INTEGER NOT NULL,
			picture_id INTEGER NOT NULL,
			FOREIGN KEY(user_id) REFERENCES user(id),
			FOREIGN KEY(picture_id) REFERENCES picture(id),
			UNIQUE(user_id, picture_id));"
	);
	Db::query(
		"CREATE TABLE comment(
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			user_id INTEGER NOT NULL,
			picture_id INTEGER NOT NULL,
			data TEXT);"
	);
} catch (Exception $e) {
	print $e;
}

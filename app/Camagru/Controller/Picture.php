<?php

namespace Camagru\Controller;

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {
	$cut = imagecreatetruecolor($src_w, $src_h);
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}
function mergeImage($a, $b)
{
	// COPY
	$b = imagescale($b, imagesx($a) / 2.6);
	imagecopymerge_alpha($a, $b, imagesx($a) / 2 - imagesx($b) / 2, imagesy($a) / 2 - imagesy($b) / 2, 0, 0, imagesx($b), imagesy($b), 100);
	// SAVE TO $a
	imagesavealpha($a, true);
	// SAVE OUTPUT
	ob_start();
	imagepng($a);
	$result =  ob_get_contents();
	ob_end_clean();
	// DESTROY AND RETURN
	imagedestroy($a);
	imagedestroy($b);
	return $result;
}

class Picture {

	public static function index() {
		echo \Camagru\View::render(\Camagru\View::$PICTURE, []);
	}

	public static function save(array $params) {
		if (array_key_exists("data", $params)) {
			$user = \Camagru\Model\User::find("username", $_SESSION["login"]);
			$data = $params["data"];
			list($type, $data) = explode(';', $data);
			list(, $data) = explode(',', $data);
			$data = base64_decode($data);
			$file_name = hash("md5", "bite") . time() . ".png";
			$file_path = PUBLIC_PATH . "image/" . $file_name;
			file_put_contents($file_path, $data);
			$pic = new \Camagru\Model\Picture([
				"user_id" => $user->getId(),
				"filename" => $file_path,
				"name" => $file_name,
				"type" => $type
			]);
			$pic->save();
			echo \Camagru\View::render(\Camagru\View::$HOME, [
				"pictures" => \Camagru\Model\Picture::all()
			]);
		}
	}

	public static function delete(array $params) {
		$comment = \Camagru\Model\Comment::find("picture_id", $params["img_id"]);
		$like = \Camagru\Model\Like::find("picture_id", $params["img_id"]);;
		$picture = \Camagru\Model\Picture::find("id", $params["img_id"]);
		if ($comment) {
			$comment->delete();
		}
		if ($like) {
			$like->delete();
		}
		$picture->delete();
		$uri = $_SERVER['HTTP_REFERER'];
		header("Location: $uri");
	}

	public static function upload(array $params) {
		$uploaddir = PUBLIC_PATH . "image";
		$uploadfile = $uploaddir . basename($_FILES["userfile"]["name"]);
		if ($_FILES["userfile"]["error"] === 4) {
			$_SESSION["message"] = "Please select a picture to upload";
		} elseif (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			$user = \Camagru\Model\User::find("username", $_SESSION["login"]);
			$picture = new \Camagru\Model\Picture([
				"user_id" => $user->getId(),
				"filename" => $uploadfile,
				"name" => $_FILES['userfile']['name'],
				"type" => $_FILES['userfile']['type']
			]);
			$picture->save();
		} else {
			$_SESSION["message"] = "There was an error uploading your picture (error_code: " . $_FILES["userfile"]["error"] . ")";
		}
		echo \Camagru\View::render(\Camagru\View::$HOME, [
			"pictures" => \Camagru\Model\Picture::all()
		]);
	}

	public static function mount(array $params) {
		$dest = "";
		if (array_key_exists("submit_lunettes", $params)) {
			$dest = PUBLIC_PATH . "image/humm.png";
		} elseif (array_key_exists("submit_dee", $params)) {
			$dest = PUBLIC_PATH . "image/wow_hum.png";
		}
		if (array_key_exists("raw", $params)) {
			$user = \Camagru\Model\User::find("username", $_SESSION["login"]);
			$data = $params["raw"];
			list($type, $data) = explode(';', $data);
			list(, $data) = explode(',', $data);
			$file_name = hash("md5", "bite") . time() . ".png";
			$file_path = PUBLIC_PATH . "image/" . $file_name;
			$data = mergeImage(
				\imagecreatefromstring(base64_decode($data)),
				\imagecreatefrompng($dest)
			);
			file_put_contents($file_path, $data);
			$pic = new \Camagru\Model\Picture([
				"user_id" => $user->getId(),
				"filename" => $file_path,
				"name" => $file_name,
				"type" => "picture"
			]);
			$pic->save();
			echo \Camagru\View::render(\Camagru\View::$HOME, [
				"pictures" => \Camagru\Model\Picture::all()
			]);
		}
	}

	public static function like(array $params) {
		if (array_key_exists("picture_id", $params) && array_key_exists("login", $_SESSION)) {
			$user = \Camagru\Model\User::find("username", $_SESSION["login"]);
			try {
				$like = new \Camagru\Model\Like([
					"user_id" => $user->getId(),
					"picture_id" => $params["picture_id"]
				]);
				$like->save();
			} catch (\PDOException $e) {
				if ($e->getCode() === "23000") {
					$_SESSION["message"] = "You already liked this picture";
				} else {
					$_SESSION["message"] = $e->getMessage();
				}
			}
		}
		header("Location: ".\Camagru\Router::$GALLERY);
	}

	public static function comment(array $params) {
		if (array_key_exists("picture_id", $params) && array_key_exists("login", $_SESSION)) {
			$user = \Camagru\Model\User::find("username", $_SESSION["login"]);
			$owner = \Camagru\Model\User::find("id", $params["author_id"]);
			$email = new \Camagru\Model\Mail\Notif($owner->getEmail());
			if ($owner->isNotified()) {
				$email->send();
			}
			$comm = new \Camagru\Model\Comment([
				"user_id" => $user->getId(),
				"picture_id" => $params["picture_id"],
				"data" => $params["comment"]
			]);
			$comm->save();
		}
		header("Location: ".\Camagru\Router::$GALLERY);
	}
}

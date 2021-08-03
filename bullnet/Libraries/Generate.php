<?php

namespace Bullnet\Libraries;

class Generate {

	public static function hash($salt = '') {
		$bytes = bin2hex(random_bytes(32));
		return sha1($bytes.$salt);
	}

	public static function string($size = "") {
		$string = str_shuffle(md5(mt_rand().time()).uniqid());
		return empty($size) ? substr($string, 0, (int)10) : substr($string, 0, (int)$size);
	}
	
}
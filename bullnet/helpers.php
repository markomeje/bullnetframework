<?php

use Bullnet\Libraries\{Session, Authenticated};
use \Illuminate\Support\Collection;
use Bullnet\Core\Config;

if (!function_exists('dump')) {
	function dump($arg = '') {
		echo '<pre>';
		var_dump($arg);
	}
}

if (!function_exists('auth')) {
	function auth() {
		return (new Authenticated());
	}
}

if (!function_exists('collection')) {
	function collection($items = []) {
		return (new Collection($items));
	}
}

if (!function_exists('config')) {
	function config() {
		return (new Config());
	}
}

	
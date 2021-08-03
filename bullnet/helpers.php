<?php

if (!function_exists('dump')) {
	function dump($arg = '') {
		echo '<pre>';
		var_dump($arg);
	}
}

	
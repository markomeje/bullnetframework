<?php

namespace Bullnet\Library;
use Bullnet\Library\Session;

class Authenticated {

	public static function user() {
		return (object)['id' => (int)Session::get('id'), 'role' => (string)Session::get('role'), 'status' => (boolean)Session::get('status'), 'uuid' => (string)Session::get('uuid'), 'token' => (string)Session::get('token')];	
	}
}
<?php

namespace Bullnet\Libraries;
use Bullnet\Libraries\Session;

class Authenticated 
{
	/**
	 * @return object
	 */
	public function user() : object
	{
		return (object)['id' => (int)Session::get('id'), 'role' => (string)Session::get('role'), 'status' => (boolean)Session::get('status'), 'uuid' => (string)Session::get('uuid'), 'token' => (string)Session::get('token')];	
	}
}
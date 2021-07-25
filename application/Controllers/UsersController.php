<?php declare(strict_types=1);


namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Users;
use Bullnet\Http\Cookie;
use Bullnet\Http\{Response};


class UsersController extends Controller {
	

	public function __construct() {
		parent::__construct();
	}

	public function index() {}

	public function upload() {
		if ($this->request->method('post')) {
			$data = ['upfile' => $this->request->file('upfile')];
			$response = (new Users())->upload($data);
			return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send();
		}
	}

}



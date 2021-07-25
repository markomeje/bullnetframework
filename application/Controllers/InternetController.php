<?php declare(strict_types=1);


namespace Bullnet\Controllers;
use Bullnet\Core\{Controller};
use Bullnet\Http\Response;


class InternetController extends Controller {

	private $status = [];
	
	public function __construct() {
		parent::__construct();
	}

	public function index() {}

	public function connection() {
		if ($this->request->method('get')) {
			switch (connection_status()) {
				case CONNECTION_NORMAL:
					$this->status = ['status' => 1, 'message' => 'You Are Connected To The Internet'];
					break;
				case CONNECTION_ABORTED:
					$this->status = ['status' => 0, 'message' => 'No Internet Connection'];
					break;
				case CONNECTION_TIMEOUT:
					$this->status = ['status' => 0, 'message' => 'Connection Timeout'];
					break;
				case (CONNECTION_TIMEOUT & CONNECTION_ABORTED):
					$this->status = ['status' => 0, 'message' => 'No Internet And Connection Timeout'];
					break;
				default:
					$this->status = ['status' => 0, 'message' => 'Undefined Connection State'];
					break;
			}
			return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $this->status))->send();
		}
	}

}



<?php declare(strict_types=1);


namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Payments;
use Bullnet\Http\{Response};


class PaymentsController extends Controller {


	public function __construct() {
		parent::__construct();
	}

	public function index() {
		View::render('backend', 'payments/index', ['title' => 'Payments']);
	}

	public function getall() {
		if ($this->request->method('get')) {
			$response = (new Payments)->getallpayments();
			return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send();
		}
	}


}




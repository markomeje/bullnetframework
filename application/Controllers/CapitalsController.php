<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Bullnet\Library\Authenticated;


class CapitalsController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response, array $argument) {
		$capitalTypes = \Bullnet\Models\Capitals::$types;
		if (Authenticated::user()->role === 'cashier') {
			$allCashierCapitals = \Bullnet\Models\Cashier\Capitals::all();
			View::render('capitals.cashier', ['title' => 'Capitals', 'allCashierCapitals' => $allCashierCapitals->all, 'capitalTypes' => $capitalTypes]);
			return $response;
		}elseif (Authenticated::user()->role === 'admin') {
			$allAdminCapitals = \Bullnet\Models\Admin\Capitals::all();
			View::render('capitals.admin', ['title' => 'Capitals', 'allAdminCapitals' => $allAdminCapitals->all, 'capitalTypes' => $capitalTypes]);
			return $response;
		}
			
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$amount = empty($input['amount']) ? 0 : $input['amount'];
		$type = empty($input['type']) ? 0 : $input['type'];
		$result = \Bullnet\Models\Capitals::add(['type' => $type, 'amount' => $amount]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

}
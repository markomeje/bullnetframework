<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Bullnet\Library\Authenticated;
use Bullnet\Models\{Products, Machines};


class RechargesController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response, array $argument) {
		if (Authenticated::user()->role === 'cashier') {
			$allCashierRecharges = \Bullnet\Models\Cashier\Recharges::all();
			View::render('recharges.cashier', ['title' => 'Recharges', 'allCashierRecharges' => $allCashierRecharges->all, 'allProducts' => Products::all(), 'allMachines' => Machines::all()]);
			return $response;
		}elseif (Authenticated::user()->role === 'admin') {
			$allAdminRecharges = \Bullnet\Models\Admin\Recharges::all();
			View::render('recharges.admin', ['title' => 'Recharges', 'allAdminRecharges' => $allAdminRecharges->all]);
			return $response;
		}
			
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$product = empty($input['product']) ? 0 : $input['product'];
		$amount = empty($input['amount']) ? 0 : $input['amount'];
		$machine = empty($input['machine']) ? 0 : $input['machine'];
		$charge = empty($input['charge']) ? 0 : $input['charge'];
		$result = \Bullnet\Models\Cashier\Recharges::add(['productid' => $product, 'machineid' => $machine, 'amount' => $amount, 'charge' => $charge]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

}
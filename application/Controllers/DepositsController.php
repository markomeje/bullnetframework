<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\{Deposits, Banks};
use Bullnet\Http\Response;
use Bullnet\Library\Authenticated;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class DepositsController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) {
		$allDeposits = Deposits::all();
		$allCashierDeposits = Deposits::cashier();
		View::render('deposits.index', ['title' => 'Deposits', 'allDeposits' => $allDeposits->all, 'allBanks' => Banks::all(), 'allCashierDeposits' => $allCashierDeposits->all]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$accountnumber = empty($input['accountnumber']) ? 0 : $input['accountnumber'];
		$charge = empty($input['charge']) ? 0 : $input['charge'];
		$bank = empty($input['bank']) ? 0 : $input['bank'];
		$amount = empty($input['amount']) ? 0 : $input['amount'];
		$result = Deposits::add(['accountnumber' => $accountnumber, 'bank' => $bank, 'amount' => $amount, 'charge' => $charge]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function edit(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$id = empty($argument['id']) ? 0 : $argument['id'];
		$accountnumber = empty($input['accountnumber']) ? 0 : $input['accountnumber'];
		$charge = empty($input['charge']) ? 0 : $input['charge'];
		$bank = empty($input['bank']) ? 0 : $input['bank'];
		$amount = empty($input['amount']) ? 0 : $input['amount'];
		$result = Deposits::edit(['accountnumber' => $accountnumber, 'bank' => $bank, 'amount' => $amount, 'charge' => $charge, 'id' => $id]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

}
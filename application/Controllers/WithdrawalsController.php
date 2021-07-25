<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\{Withdrawals, Banks};
use Bullnet\Http\Response;
use Bullnet\Library\Authenticated;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class WithdrawalsController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) {
		$allWithdrawals = Withdrawals::all();
		$allCashierWithdrawals = Withdrawals::cashier();
		View::render('withdrawals.index', ['title' => 'Withdrawals', 'allWithdrawals' => $allWithdrawals->all, 'allBanks' => Banks::all(), 'allCashierWithdrawals' => $allCashierWithdrawals->all]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$phone = empty($input['phone']) ? 0 : $input['phone'];
		$charge = empty($input['charge']) ? 0 : $input['charge'];
		$bank = empty($input['bank']) ? 0 : $input['bank'];
		$amount = empty($input['amount']) ? 0 : $input['amount'];
		$result = Withdrawals::add(['phone' => $phone, 'bank' => $bank, 'amount' => $amount, 'charge' => $charge]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function edit(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$id = empty($argument['id']) ? 0 : $argument['id'];
		$phone = empty($input['phone']) ? 0 : $input['phone'];
		$charge = empty($input['charge']) ? 0 : $input['charge'];
		$bank = empty($input['bank']) ? 0 : $input['bank'];
		$amount = empty($input['amount']) ? 0 : $input['amount'];
		$result = Withdrawals::edit(['phone' => $phone, 'bank' => $bank, 'amount' => $amount, 'charge' => $charge, 'id' => $id]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

}
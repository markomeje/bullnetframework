<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Cashiers;
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class CashiersController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) {
		// $faker = \Faker\Factory::create();
		// for ($i=0; $i < 35; $i++) {
		//     $name = explode(' ', $faker->name);
		// 	Cashiers::add(['firstname' => $name[0], 'lastname' => $name[1], 'email' => $faker->email, 'phone' => $faker->phoneNumber, 'address' => $faker->sentence]);
		// }
		$allCashiers = Cashiers::all();
		View::render('cashiers.index', ['title' => 'Cashiers', 'allCashiers' => $allCashiers->all, 'pagination' => $allCashiers->pagination]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$firstname = empty($input['firstname']) ? 0 : $input['firstname'];
		$lastname = empty($input['lastname']) ? 0 : $input['lastname'];
		$email = empty($input['email']) ? 0 : $input['email'];
		$phone = empty($input['phone']) ? 0 : $input['phone'];
		$address = empty($input['address']) ? 0 : $input['address'];
		$result = Cashiers::add(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'address' => $address]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function edit(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$userid = empty($argument['userid']) ? 0 : $argument['userid'];
		$firstname = empty($input['firstname']) ? 0 : $input['firstname'];
		$lastname = empty($input['lastname']) ? 0 : $input['lastname'];
		$phone = empty($input['phone']) ? 0 : $input['phone'];
		$address = empty($input['address']) ? 0 : $input['address'];
		$result = Cashiers::edit(['userid' => $userid, 'firstname' => $firstname, 'lastname' => $lastname, 'phone' => $phone, 'address' => $address]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function delete(RequestInterface $request, ResponseInterface $response, array $argument) {
		$userid = empty($argument['userid']) ? 0 : $argument['userid'];
		$result = Cashiers::delete($userid);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

}
<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Machines;
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class MachinesController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) {
		View::render('machines.index', ['title' => 'Machines', 'allMachines' => Machines::all()]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$name = empty($input['name']) ? 0 : $input['name'];
		$result = Machines::add($name);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

}
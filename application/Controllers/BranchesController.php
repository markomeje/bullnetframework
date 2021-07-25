<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Branches;
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class BranchesController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response, array $argument) {
		View::render('branches.index', ['title' => 'Branches', 'allBranches' => Branches::all()]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$address = empty($input['address']) ? 0 : $input['address'];
		$name = empty($input['name']) ? 0 : $input['name'];
		$result = Branches::add(['address' => $address, 'name' => $name]);
		return (new Response(200, ['Content-Type: application/json;'], $response))->send($result);
	}

}
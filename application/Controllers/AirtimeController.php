<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Airtime;
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class AirtimeController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response, array $argument) {
		View::render('airtime.index', ['title' => 'Airtime', 'allAirtime' => Airtime::all()]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$fullname = empty($input['fullname']) ? 0 : $input['fullname'];
		$shortname = empty($input['shortname']) ? 0 : $input['shortname'];
		$result = Airtime::add(['fullname' => $fullname, 'shortname' => $shortname]);
		return (new Response(200, ['Content-Type: application/json;'], $response))->send($result);
	}

	public function edit(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$shortname = empty($input['shortname']) ? 0 : $input['shortname'];
		$id = empty($argument['id']) ? 0 : $argument['id'];
		$fullname = empty($input['fullname']) ? 0 : $input['fullname'];
		$result = Airtime::edit(['fullname' => $fullname, 'shortname' => $shortname, 'id' => $id]);
		return (new Response(200, ['Content-Type: application/json;'], $response))->send($result);
	}

}
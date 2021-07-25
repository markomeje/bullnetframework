<?php declare(strict_types=1);


namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Bullnet\Library\Authenticated;


class DashboardController extends Controller {

	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) {
		if (Authenticated::user()->role === 'cashier') {
			View::render('dashboard.cashier', ['title' => 'Dashboard']);
			return $response;
		}elseif (Authenticated::user()->role === 'admin') {
			View::render('dashboard.admin', ['title' => 'Dashboard']);
			return $response;
		}
			
	}

}



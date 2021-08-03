<?php 
declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\{Articles, Categories, Users};
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Bullnet\Library\Authenticated;


class AboutController extends Controller {

	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) {
		$allArticles = Articles::published();
		View::render('about.index', ['title' => 'About | DestinySpark', 'allArticles' => $allArticles->all, 'user' => Users::find('id', Authenticated::user()->id)]);
		return $response;
	}
}
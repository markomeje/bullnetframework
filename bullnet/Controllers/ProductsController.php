<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Products;
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class ProductsController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response, array $argument) {
		View::render('products.index', ['title' => 'Products', 'allProducts' => Products::all()]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$productname = empty($input['productname']) ? 0 : $input['productname'];
		$result = Products::add(['productname' => $productname]);
		return (new Response(200, ['Content-Type: application/json;'], $response))->send($result);
	}

	public function edit(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$id = empty($argument['id']) ? 0 : $argument['id'];
		$productname = empty($input['productname']) ? 0 : $input['productname'];
		$result = Products::edit(['productname' => $productname, 'id' => $id]);
		return (new Response(200, ['Content-Type: application/json;'], $response))->send($result);
	}

}
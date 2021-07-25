<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Categories;
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class CategoriesController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) {
		View::render('categories.index', ['title' => 'Categories | DestinySpark', 'categories' => Categories::all()]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$name = empty($input['name']) ? 0 : $input['name'];
		$result = Categories::add($name);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function edit(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$id = empty($argument['id']) ? 0 : $argument['id'];
		$name = empty($input['name']) ? 0 : $input['name'];
		$result = Categories::edit(['name' => $name, 'id' => $id]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function delete(RequestInterface $request, ResponseInterface $response, array $argument) {
		$id = empty($argument['id']) ? 0 : $argument['id'];
		$result = Categories::delete($id);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

}
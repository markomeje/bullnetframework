<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Comments;
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class CommentsController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) {
		View::render('comments.index', ['title' => 'Comments | DestinySpark', 'allComments' => Comments::all()]);
		return $response;
	}

	public function add(array $argument) {
		$input = Input::post();
		$articleid = empty($argument['articleid']) ? 0 : $argument['articleid'];
		$comment = empty($input->comment ? '' : $input->comment;
		$result = Comments::create(['comment' => $comment, 'articleid' => $articleid]);
		return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send($result);
	}

	public function edit(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$id = empty($argument['id']) ? 0 : $argument['id'];
		$name = empty($input['name']) ? 0 : $input['name'];
		$result = Comments::edit(['name' => $name, 'id' => $id]);
		return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send($result);
	}

	public function delete(RequestInterface $request, ResponseInterface $response, array $argument) {
		$id = empty($argument['id']) ? 0 : $argument['id'];
		$result = Comments::delete($id);
		return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send($result);
	}

}
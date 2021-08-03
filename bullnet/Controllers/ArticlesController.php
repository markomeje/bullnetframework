<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\{Articles, Categories, Users};
use Bullnet\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Bullnet\Library\Authenticated;


class ArticlesController extends Controller {

	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response, array $argument) {
		$number = empty($argument['number']) ? 0 : $argument['number'];
		$allArticles = Articles::all($number);
		View::render('articles.index', ['title' => 'Articles Listings', 'allArticles' => $allArticles->all, 'allCategories' => Categories::all(), 'pagination' => $allArticles->pagination, 'user' => Users::find('id', Authenticated::user()->id)]);
		return $response;
	}

	public function create(RequestInterface $request, ResponseInterface $response) {
		View::render('articles.create', ['title' => 'Create Post | DestinySpark', 'allCategories' => Categories::all(), 'statuses' => Articles::$statuses]);
		return $response;
	}

	public function add(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$title = empty($input['title']) ? 0 : $input['title'];
		$category = empty($input['category']) ? 0 : $input['category'];
		$author = empty($input['author']) ? 0 : $input['author'];
		$status = empty($input['status']) ? 0 : $input['status'];
		$content = empty($input['content']) ? 0 : $input['content'];
		$result = Articles::create(['title' => $title, 'category' => $category, 'author' => $author, 'content' => $content, 'status' => $status]);
		return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send($result);
	}

	public function update(RequestInterface $request, ResponseInterface $response, array $argument) {
		$articleid = empty($argument['articleid']) ? 0 : $argument['articleid'];
		$redirect = empty($argument['redirect']) ? 0 : $argument['redirect'];
		View::render('articles.update', ['title' => 'Update Article', 'allArticles' => Articles::all(), 'articleid' => $articleid, 'article' => Articles::find($articleid), 'allCategories' => Categories::all(), 'allArticleStatus' => Articles::$statuses]);
		return $response;
	}

	public function edit(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$title = empty($input['title']) ? 0 : $input['title'];
		$category = empty($input['category']) ? 0 : $input['category'];
		$author = empty($input['author']) ? 0 : $input['author'];
		$status = empty($input['status']) ? 0 : $input['status'];
		$content = empty($input['content']) ? 0 : $input['content'];
		$articleid = empty($argument['articleid']) ? 0 : $argument['articleid'];
		$result = Articles::edit(['id' => $articleid, 'title' => $title, 'category' => $category, 'author' => $author, 'content' => $content, 'status' => $status]);
		return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send($result);
	}

	public function delete(RequestInterface $request, ResponseInterface $response, array $argument) {
		$articleid = empty($argument['articleid']) ? 0 : $argument['articleid'];
		$result = Articles::delete($articleid);
		return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send($result);
	}

	public function upload(RequestInterface $request, ResponseInterface $response, array $argument) {
		$uploadedFiles = $request->getUploadedFiles();
		$articleid = empty($argument['articleid']) ? 0 : $argument['articleid'];
		$result = Articles::upload(['image' => $uploadedFiles['blogimage'], 'id' => $articleid]);
		return (new Response(200, ['Content-Type: application/json; charset=UTF-8', 'Access-Control-Allow-Origin: *'], $response))->send($result);
	}

}
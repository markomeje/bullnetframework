<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Http\Request;
use Bullnet\Models\{Articles, Categories, Comments, Users};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Bullnet\Library\Authenticated;


class BlogController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response, $argument) {
		$pagenumber = empty($argument['pagenumber']) ? 0 : $argument['pagenumber'];
		$publishedArticles = Articles::published($pagenumber);
		$allArticles = Articles::all();
		View::render('blog.index', ['title' => 'Blog | DestinySpark', 'allPublishedArticles' => $publishedArticles->all, 'allCategories' => Categories::all(), 'pagination' => $publishedArticles->pagination, 'allArticles' => $allArticles->all, 'user' => Users::find('id', Authenticated::user()->id)]);
		return $response;
	}

	public function article(RequestInterface $request, ResponseInterface $response, $argument) {
		$articleid = empty($argument['articleid']) ? 0 : $argument['articleid'];
		$publishedArticles = Articles::published();
		View::render('blog.article', ['title' => 'Blog | DestinySpark', 'allCategories' => Categories::all(), 'article' => Articles::find($articleid), 'articleid' => (int)$articleid, 'allPublishedArticles' => $publishedArticles->all, 'articleComments' => Comments::random($articleid)]);
		return $response;
	}

	public function category(RequestInterface $request, ResponseInterface $response, $argument) {
		$categoryid = empty($argument['categoryid']) ? 0 : $argument['categoryid'];
		$publishedArticles = Articles::published();
		$allArticles = Articles::all();
		$allArticlesByCategory = Articles::category($categoryid);
		View::render('blog.category', ['title' => 'Blog Category', 'allPublishedArticles' => $publishedArticles->all, 'allCategories' => Categories::all(), 'allArticlesByCategory' => $allArticlesByCategory->all, 'allArticles' => $allArticles->all, 'categoryid' => $categoryid]);
		return $response;
	}

}
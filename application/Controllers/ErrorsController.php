<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Http\Request;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class ErrorsController extends Controller {

	/**
     * @var string
     */
    private $title = 'Page Not Found';

    /**
     * @var string
     */
    private $message = 'Page Not Found';

    /**
     * @var int
     */
    private $code = 404;

	
	public function __construct() 
	{
		parent::__construct();
	}

	public function index(RequestInterface $request, ResponseInterface $response) : ResponseInterface
	{
		http_response_code($this->code);
		View::render('errors.404', ['title' => htmlentities($this->title, ENT_COMPAT|ENT_HTML5, 'utf-8'), 'message' => htmlentities($this->message, ENT_COMPAT|ENT_HTML5, 'utf-8'), 'code' => $this->code]);
		return $response;
	}

}



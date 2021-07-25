<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Login;
use Bullnet\Http\{Response, Cookie};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class LoginController extends Controller {
    

	public function __construct(){}

	public function index(RequestInterface $request, ResponseInterface $response) {
		View::render('login.index', ['title' => 'Login']);
		return $response;
	}

	public function signin(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$email = empty($input['email']) ? 0 : $input['email'];
		$rememberme = empty($input['rememberme']) ? 0 : $input['rememberme'];
		$password = empty($input['password']) ? 0 : $input['password'];
		$result = Login::handle(['email' => $email, 'password' => $password, 'rememberme' => $rememberme]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function logout(RequestInterface $request, ResponseInterface $response) {
		$result = Login::logout();
		return (new Response(200, ['Content-Type: application/json', 'Access-Control-Allow-Origin: *'], $response))->send($result);
	}

}



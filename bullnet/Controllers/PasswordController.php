<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Password;
use Bullnet\Http\{Response, Cookie};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class PasswordController extends Controller {
    

	public function __construct(){}

	public function index(RequestInterface $request, ResponseInterface $response, array $argument) {
		$token = empty($argument['token']) ? 0 : $argument['token'];
		$result = Password::verify($token);
		View::render('password.reset', ['title' => 'Reset Password', 'verification' => $result, 'token' => $token]);
	    return $response;
    }

	public function process(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$processemail = empty($input['processemail']) ? 0 : $input['processemail'];
		$result = Password::process(['processemail' => $processemail]);
		return (new Response(200, ['Content-Type: application/json;'], $response))->send($result);
	}

	public function reset(RequestInterface $request, ResponseInterface $response, array $argument) {
		$input = (array)$request->getParsedBody();
		$token = empty($input['token']) ? 0 : $input['token'];
		$password = empty($input['password']) ? 0 : $input['password'];
		$confirmpassword = empty($input['confirmpassword']) ? 0 : $input['confirmpassword'];
		$result = Password::reset(['password' => $password, 'confirmpassword' => $confirmpassword, 'token' => $token]);
		return (new Response(200, ['Content-Type: application/json;'], $response))->send($result);
		
	}

}



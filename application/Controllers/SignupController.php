<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Signup;
use Bullnet\Http\{Response, Cookie};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class SignupController extends Controller {
    

	public function __construct(){}

	public function index(RequestInterface $request, ResponseInterface $response) {
		View::render('signup.index', ['title' => 'Signup']);
		return $response;
	}

	public function signup(RequestInterface $request, ResponseInterface $response) {
		$input = (array)$request->getParsedBody();
		$email = empty($input['email']) ? 0 : $input['email'];
		$phone = empty($input['phone']) ? 0 : $input['phone'];
		$password = empty($input['password']) ? 0 : $input['password'];
		$confirmpassword = empty($input['confirmpassword']) ? 0 : $input['confirmpassword'];
		$result = Signup::handle(['email' => $email, 'phone' => $phone, 'password' => $password, 'confirmpassword' => $confirmpassword]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function thanks(RequestInterface $request, ResponseInterface $response) {
		View::render('signup.thanks', ['title' => 'Signup Successfull']);
		return $response;
	}

}



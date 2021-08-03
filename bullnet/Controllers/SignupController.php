<?php declare(strict_types=1);

namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Models\Signup;
use Bullnet\Http\{Response, Cookie};
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


class SignupController extends Controller 
{
    

	public function index($response) 
	{
		return View::render('signup.index', [
			'title' => 'Signup'
		], $response);
	}

	public function signup($request, $response) 
	{
		$input = (array)$request->getParsedBody();
		$email = empty($input['email']) ? null : $input['email'];
		$phone = empty($input['phone']) ? null : $input['phone'];
		$password = empty($input['password']) ? null : $input['password'];
		$confirmpassword = empty($input['confirmpassword']) ? null : $input['confirmpassword'];
		$result = Signup::handle(['email' => $email, 'phone' => $phone, 'password' => $password, 'confirmpassword' => $confirmpassword]);
		return (new Response(200, ['Content-Type: application/json'], $response))->send($result);
	}

	public function thanks($response) 
	{
		return View::render('signup.thanks', [
			'title' => 'Signup Successfull'
		], $response);
	}

}



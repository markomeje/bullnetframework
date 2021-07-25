<?php 

declare(strict_types=1);
namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Http\Response;
use Bullnet\Models\Users;


class HomeController extends Controller 
{
	

	/**
     * @return void
     */
	public function __construct()
	{
		parent::__construct();
	}

	public function index($response)
	{
		// echo "<pre>";
		// var_dump(Users::collect()->all());
		$count = Users::signup([
			'email' => 'rendom@mail.com',
			'password' => password_hash('1234', PASSWORD_DEFAULT),
			'role' => 'user',
			'status' => 'active'
		])->count();
		dump($count);
		die();
		// $faker = \Faker\Factory::create();
		// for ($i=0; $i < 50; $i++) { 
		// 	$result = User::signup([
		// 		'email' => $faker->email,
		// 		'password' => password_hash('1234', PASSWORD_DEFAULT),
		// 		'role' => $faker->optional($weight = 0.5, $default = 'admin')->word,
		// 		'status' => $faker->optional($weight = 0.5, $default = 'active')->word,
		// 	])->count();
		// }

		// var_dump($result);
			

		return View::render('home.index', [
			'title' => 'Home'
		], $response);

	}

	public function add($request, $response)
	{
		$input = (new \Bullnet\Http\Request($request))->data();
		$email = $input->post('email');
		$passwword = $input->post('passwword');
		$username = $input->post('username');
		$confirmpassword = $input->post('confirmpassword');

		$validate = Validator::validate([
			'email' => [v::notEmpty($email), v::email()],
			'passwword' => []
		]);
	}

}



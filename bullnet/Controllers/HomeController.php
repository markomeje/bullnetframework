<?php 

declare(strict_types=1);
namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};
use Bullnet\Http\Response;
use Bullnet\Models\{Users, Comments};


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
		$faker = \Faker\Factory::create();
		$userid = $faker->optional($weight = 100)->randomDigit;
		$result = Comments::collect();
		
		echo "<pre>";
		var_dump($result);
		die();

		return View::render('home.index', [
			'title' => 'Home'
		], $response);

	}

	public function add($request, $response)
	{}

}



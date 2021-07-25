<?php declare(strict_types=1);


namespace Bullnet\Controllers;
use Bullnet\Core\{Controller, View};


class AdminController extends Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = ["title" => "Admin"];
		View::render("backend", "admin/index", $data);
	}

	public function admin() {
		return true;
	}

}



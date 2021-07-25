<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Database};
use \Exception;


class Payments extends Model {

    /**
     * @var string
     */
	private $table = "payments";
	

	public function __construct() {
		parent::__construct();
	}

	public function getall() {
		try {
			$database = Database::connect();
			$database->prepare("SELECT * FROM $this->table ORDER BY date DESC");
			$database->execute();
            return $database->fetchAll();
		} catch (Exception $error) {
			Logger::log("GETTING ALL PAYMENTS ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

}
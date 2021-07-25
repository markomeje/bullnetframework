<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Validate, Database};
use Respect\Validation\Validator as v;
use \Exception;


class Machines extends Model {

    /**
     * @var string
     */
	private static $table = 'machines';

	public function __construct() {
		parent::__construct();
	}

	public static function add($name) {
		if (!v::notEmpty()->length(3, 255)->validate($name)) {
			return ['status' => 0, 'field' => 'name', 'info' => 'Please machine name is required.'];
		}elseif (self::exists($name) !== false) {
			return ['status' => 0, 'field' => 'name', 'info' => 'Machine already exists'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("INSERT INTO {$table} (name) VALUES(:name)", ['name' => $name]);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Machine added'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("ADDING MACHINES ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed.'];
		}
	}

	public static function all() {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} ORDER BY machinename DESC");
            return $database->fetchAll();
		} catch (Exception $error) {
			Logger::log("GETTING ALL MACHINES ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function exists($name) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} WHERE name = :name LIMIT 1", ['name' => $name]);
            return $database->fetch();
		} catch (Exception $error) {
			Logger::log("MACHINE NAME EXISTS ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function find($id) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} WHERE id = :id LIMIT 1", ['id' => $id]);
            return $database->fetch();
		} catch (Exception $error) {
			Logger::log("FINDING CATEGORY ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

}
<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Database, Pagination};
use Respect\Validation\Validator as v;
use \Exception;


class Banks extends Model {

    /**
     * @var string
     */
	private static $table = 'banks';

	public function __construct() {
		parent::__construct();
	}

	public static function add($data) {
		if (!v::notEmpty()->length(3, 255)->validate($data['fullname'])) {
			return ['status' => 0, 'field' => 'fullname', 'info' => 'Please bank fullname is required.'];
		}elseif (self::find('fullname', $data['fullname']) !== false) {
			return ['status' => 0, 'field' => 'fullname', 'info' => 'Bank fullname already exists'];
		}elseif (!v::notEmpty()->length(3, 255)->validate($data['shortname'])) {
			return ['status' => 0, 'field' => 'shortname', 'info' => 'Please bank shortname is required.'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("INSERT INTO {$table} (fullname, shortname) VALUES(:fullname, :shortname)", $data);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Bank added successfully.'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("ADDING BANK ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed.'];
		}
	}

	public static function all() {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} ORDER BY fullname ASC");
            return $database->fetchAll();
		} catch (Exception $error) {
			Logger::log("GETTING ALL BANKS ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function find($field, $value) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} WHERE {$field} = :{$field} LIMIT 1", ["{$field}" => $value]);
            return $database->fetch();
		} catch (Exception $error) {
			Logger::log("FINDING ". ucfirst((string)$field) ." ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function edit($data) {
		if (!v::notEmpty()->length(3, 255)->validate($data['fullname'])) {
			return ['status' => 0, 'field' => 'fullname', 'info' => 'Please bank fullname is required.'];
		}elseif (!v::notEmpty()->length(3, 255)->validate($data['shortname'])) {
			return ['status' => 0, 'field' => 'shortname', 'info' => 'Please bank shortname is required.'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("UPDATE {$table} SET fullname = :fullname, shortname = :shortname WHERE id = :id LIMIT 1", $data);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Bank updated successfully'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("EDITING BANK ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed.'];
		}
	}

	public static function delete($id) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("DELETE FROM {$table} WHERE id = :id LIMIT 1", ['id' => $id]);
            return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'BANK deleted'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("DELETING BANK ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed'];
		}
	}

}
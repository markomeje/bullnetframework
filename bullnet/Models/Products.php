<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Database, Pagination};
use Respect\Validation\Validator as v;
use \Exception;


class Products extends Model {

    /**
     * @var string
     */
	private static $table = 'products';
    

	public function __construct() {
		parent::__construct();
	}

	public static function add($data) {
		if (!v::notEmpty()->length(3, 255)->validate($data['productname'])) {
			return ['status' => 0, 'field' => 'productname', 'info' => 'Please product name is required.'];
		}elseif (self::find('productname', $data['productname']) !== false) {
			return ['status' => 0, 'field' => 'productname', 'info' => 'Product name already exists'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("INSERT INTO {$table} (productname) VALUES(:productname)", $data);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Procuct added successfully.'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("ADDING BANK ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed.'];
		}
	}

	public static function all() {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} ORDER BY productname ASC");
            return $database->fetchAll();
		} catch (Exception $error) {
			Logger::log("GETTING ALL PRODUCTS ERROR", $error->getMessage(), __FILE__, __LINE__);
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
		if (!v::notEmpty()->length(3, 255)->validate($data['productname'])) {
			return ['status' => 0, 'field' => 'productname', 'info' => 'Please bank productname is required.'];
		}elseif (!v::notEmpty()->length(3, 255)->validate($data['shortname'])) {
			return ['status' => 0, 'field' => 'shortname', 'info' => 'Please bank shortname is required.'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("UPDATE {$table} SET productname = :productname, shortname = :shortname WHERE id = :id LIMIT 1", $data);
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
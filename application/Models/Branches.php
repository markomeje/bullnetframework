<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Database, Pagination, Authenticated};
use Respect\Validation\Validator as v;
use \Exception;


class Branches extends Model {

    /**
     * @var string
     */
	private static $table = 'branches';

	public function __construct() {
		parent::__construct();
	}

	public static function add($data) {
		if (!v::notEmpty()->length(3, 255)->validate($data['name'])) {
			return ['status' => 0, 'field' => 'name', 'info' => 'Please branch name must be between 3 - 255 characters.'];
		}elseif (self::find('name', $data['name']) !== false) {
			return ['status' => 0, 'field' => 'name', 'info' => 'Branch name already exists'];
		}elseif (!v::notEmpty()->validate($data['address'])) {
			return ['status' => 0, 'field' => 'address', 'info' => 'Please branch address is required.'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("INSERT INTO {$table} (name, address, uuid) VALUES(:name, :address, :uuid)", array_merge($data, ['uuid' => Authenticated::user()->uuid]));
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Branch added successfully.'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("ADDING Branch ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed.'];
		}
	}

	public static function all() {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} WHERE uuid = :uuid ORDER BY name ASC", ['uuid' => Authenticated::user()->uuid]);
            return $database->fetchAll();
		} catch (Exception $error) {
			Logger::log("GETTING ALL Branches ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function find($field, $value) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} WHERE {$field} = :{$field} AND uuid = :uuid LIMIT 1", ["{$field}" => $value, 'uuid' => Authenticated::user()->uuid]);
            return $database->fetch();
		} catch (Exception $error) {
			Logger::log("FINDING ". ucfirst((string)$field) ." ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function edit($data) {
		if (!v::notEmpty()->length(3, 255)->validate($data['name'])) {
			return ['status' => 0, 'field' => 'name', 'info' => 'Please branch name is required.'];
		}elseif (!v::notEmpty()->length(3, 255)->validate($data['address'])) {
			return ['status' => 0, 'field' => 'address', 'info' => 'Please branch address is required.'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("UPDATE {$table} SET name = :name, address = :address WHERE id = :id LIMIT 1", $data);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Branch updated successfully'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("EDITING Branch ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed.'];
		}
	}

	public static function delete($id) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("DELETE FROM {$table} WHERE id = :id LIMIT 1", ['id' => $id]);
            return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Branch deleted'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("DELETING Branch ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed'];
		}
	}

}
<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Generate, Database, Authenticated, Mailer, Pagination};
use Respect\Validation\Validator as v;
use \Exception;


class Cashiers extends Model {

	private static $table = 'cashiers';

	public function __construct() {
		parent::__construct();
	}

	public static function add($data) {
		if (!v::notEmpty()->length(3, 55)->validate($data['firstname'])) {
            return ['status' => 0, 'field' => 'firstname', 'info' => 'Firstname must be between 3 - 55 characters.'];
        }elseif (!v::notEmpty()->length(3, 55)->validate($data['lastname'])) {
            return ['status' => 0, 'field' => 'lastname', 'info' => 'Lastname must be between 3 - 55 characters.'];
        }elseif (!v::email()->validate($data['email'])) {
    		return ['status' => 0, 'field' => 'email', 'info' => 'Invalid email.'];
        }elseif (Users::find('email', $data['email']) !== false) {
            return ['status' => 0, 'field' => 'email', 'info' => 'Email already in use. Try another.'];
        }elseif (!v::notEmpty()->length(11)->validate($data['phone'])) {
            return ['status' => 0, 'field' => 'phone', 'info' => 'Invalid phone number'];
    	}

		try {
            $token = Generate::string(32);
            $database = Database::connect();
            $database->beginTransaction();
            $user = Users::create(['email' => $data['email'], 'password' => null, 'uuid' => Authenticated::user()->uuid, 'status' => 'inactive', 'role' => 'cashier', 'token' => $token]);
            
            $table = self::$table;
            $database->query("INSERT INTO {$table} (firstname, lastname, uuid, phone, userid, address) VALUES(:firstname, :lastname, :uuid, :phone, :userid, :address)", ['firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'uuid' => Authenticated::user()->uuid, 'phone' => $data['phone'], 'address' => $data['address'], 'userid' => $user]);

            Mailer::mail(EMAIL_VERIFICATION, $data['email'], ['token' => $token]);
            $database->commit();
            return ['status' => 1, 'info' => 'Cashier added successfully.']; 
        } catch (Exception $error) {
        	$database->rollback();
            Logger::log("ADDING WORKER ERROR", $error->getMessage(), __FILE__, __LINE__);
            return ['status' => 0, 'info' => 'Operation failed.']; 
        }
	}

	public static function all($pageNumber = 0, $itemsPerPage = 25) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$pagination = Pagination::paginate("SELECT * FROM {$table} WHERE uuid = :uuid", ['uuid' => Authenticated::user()->uuid], $pageNumber, $itemsPerPage);
			$database->query("SELECT {$table}.*, users.email FROM {$table}, users WHERE {$table}.uuid = :uuid AND {$table}.userid = users.id ORDER BY date DESC LIMIT {$itemsPerPage} OFFSET {$pagination->getOffset()}", ['uuid' => Authenticated::user()->uuid]);
            return (object)['all' => $database->fetchAll(), 'pagination' => $pagination];
		} catch (Exception $error) {
			Logger::log("GETTING ALL CASHIERS ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function edit($data) {
		if (!v::notEmpty()->length(3, 55)->validate($data['firstname'])) {
            return ['status' => 0, 'field' => 'firstname', 'info' => 'Firstname must be between 3 - 55 characters.'];
        }elseif (!v::notEmpty()->length(3, 55)->validate($data['lastname'])) {
            return ['status' => 0, 'field' => 'lastname', 'info' => 'Lastname must be between 3 - 55 characters.'];
        }elseif (!v::notEmpty()->length(11)->validate($data['phone'])) {
            return ['status' => 0, 'field' => 'phone', 'info' => 'Invalid phone number'];
    	}

		try {
			$token = Generate::string(32);
            $database = Database::connect();
			$table = self::$table;
			$database->query("UPDATE {$table} SET firstname = :firstname, lastname = :lastname, phone = :phone, address = :address WHERE userid = :userid LIMIT 1", $data);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Cashier updated successfully.'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("EDITING Cashier ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed.'];
		}
	}

	public static function delete($id) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("DELETE FROM {$table} WHERE id = :id LIMIT 1", ['id' => $id]);
            return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Cashier deleted'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("DELETING Cashier ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed'];
		}
	}

	public static function find($id) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("SELECT * FROM {$table} WHERE id = :id LIMIT 1", ['id' => $id]);
            return $database->fetch();
		} catch (Exception $error) {
			Logger::log("FINDING Cashier ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

}
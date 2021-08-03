<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Generate, Database, Authenticated, Pagination};
use Respect\Validation\Validator as v;
use \Exception;


class Withdrawals extends Model {

	private static $table = 'withdrawals';

	public function __construct() {
		parent::__construct();
	}

	public static function add($data) {
		if (!v::notEmpty()->length(11)->validate($data['phone'])) {
            return ['status' => 0, 'field' => 'phone', 'info' => 'Phone number must be 11 characters.'];
        }elseif (!v::notEmpty()->validate($data['bank'])) {
            return ['status' => 0, 'field' => 'bank', 'info' => 'Please select bank name.'];
        }elseif (!v::notEmpty()->validate($data['amount'])) {
    		return ['status' => 0, 'field' => 'amount', 'info' => 'Invalid amount.'];
        }elseif (!v::notEmpty()->validate($data['charge'])) {
            return ['status' => 0, 'field' => 'charge', 'info' => 'Invalid charge.'];
    	}

		try {
            $fields = array_merge($data, ['cashierid' => Authenticated::user()->id, 'uuid' => Authenticated::user()->uuid]);
            $database = Database::connect();
            $table = self::$table;
            $database->query("INSERT INTO {$table} (phone, bank, uuid, amount, cashierid, charge) VALUES(:phone, :bank, :uuid, :amount, :cashierid, :charge)", $fields);
            return $database->rowCount() > 0 ? ['status' => 1, 'info' => 'Withdrawal added successfully.'] : ['status' => 0, 'info' => 'Operation failed. Try again']; 
        } catch (Exception $error) {
            Logger::log("ADDING Withdrawal ERROR", $error->getMessage(), __FILE__, __LINE__);
            return ['status' => 0, 'info' => 'Operation failed.']; 
        }
	}

	public static function all($pageNumber = 0, $itemsPerPage = 29) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$pagination = Pagination::paginate("SELECT * FROM {$table} WHERE uuid = :uuid", ['uuid' => Authenticated::user()->uuid], $pageNumber, $itemsPerPage);
			$database->query("SELECT {$table}.*, banks.shortname AS bankname FROM {$table}, banks WHERE {$table}.uuid = :uuid ORDER BY date DESC LIMIT {$itemsPerPage} OFFSET {$pagination->getOffset()}", ['uuid' => Authenticated::user()->uuid]);
			return (object)['all' => $database->fetchAll(), 'pagination' => $pagination];
		} catch (Exception $error) {
			Logger::log("GETTING ALL WITHDRAWALS ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}
    
    /**
     * Cashier Withdrawals
     */
	public static function cashier($pageNumber = 0, $itemsPerPage = 25) {
		try {
			$database = Database::connect();
			$table = self::$table;
			$whereClause = ['cashierid' => Authenticated::user()->id, 'uuid' => Authenticated::user()->uuid];
			$pagination = Pagination::paginate("SELECT * FROM {$table} WHERE uuid = :uuid AND cashierid = :cashierid", $whereClause, $pageNumber, $itemsPerPage);
			$database->query("SELECT {$table}.*, banks.shortname AS bankname FROM {$table}, banks WHERE {$table}.uuid = :uuid AND cashierid = :cashierid AND banks.id = {$table}.bank ORDER BY date DESC LIMIT {$itemsPerPage} OFFSET {$pagination->getOffset()}", $whereClause);
			return (object)['all' => $database->fetchAll(), 'pagination' => $pagination];
		} catch (Exception $error) {
			Logger::log("GETTING ALL CASHIER WITHDRAWALS ERROR", $error->getMessage(), __FILE__, __LINE__);
			return false;
		}
	}

	public static function edit($data) {
		if (!v::notEmpty()->length(11)->validate($data['phone'])) {
            return ['status' => 0, 'field' => 'phone', 'info' => 'Phone number must be 11 characters.'];
        }elseif (!v::notEmpty()->validate($data['bank'])) {
            return ['status' => 0, 'field' => 'bank', 'info' => 'Please select bank name.'];
        }elseif (!v::notEmpty()->validate($data['amount'])) {
    		return ['status' => 0, 'field' => 'amount', 'info' => 'Invalid amount.'];
        }elseif (!v::notEmpty()->validate($data['charge'])) {
            return ['status' => 0, 'field' => 'charge', 'info' => 'Invalid charge.'];
    	}

		try {
			$database = Database::connect();
			$table = self::$table;
			$database->query("UPDATE {$table} SET phone = :phone, amount = :amount, bank = :bank, charge = :charge WHERE id = :id LIMIT 1", $data);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Category updated successfully.'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("EDITING WITHDRAWAL ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed'];
		}
	}

}
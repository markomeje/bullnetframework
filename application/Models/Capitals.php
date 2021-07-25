<?php

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Database, Pagination, Authenticated};
use Respect\Validation\Validator as v;
use Bullnet\Models\Capitals;
use \Exception;


class Capitals extends Model {

    /**
     * @var string
     */
	private static $table = 'capitals';

	/**
	 * Networks
	 */
    public static $types = ['Opening Balance', 'Additionals'];
    

	public function __construct() {
		parent::__construct();
	}

	public static function add($data) {
		if (!v::notEmpty()->length(3, 255)->validate($data['amount'])) {
			return ['status' => 0, 'field' => 'amount', 'info' => 'Please amount is required.'];
		}elseif (!v::notEmpty()->length(3, 255)->validate($data['type'])) {
			return ['status' => 0, 'field' => 'type', 'info' => 'Please select type.'];
		}

		try {
			$database = Database::connect();
			$table = self::$table;
			$fields = array_merge($data, ['userid' => Authenticated::user()->id, 'uuid' => Authenticated::user()->uuid]);
			$database->query("INSERT INTO {$table} (amount, type, uuid, userid) VALUES(:amount, :type, :uuid, :userid)", $fields);
			return ($database->rowCount() > 0) ? ['status' => 1, 'info' => 'Capital added successfully.'] : ['status' => 0, 'info' => 'Operation failed. Try again.'];
		} catch (Exception $error) {
			Logger::log("ADDING CAPITALS ERROR", $error->getMessage(), __FILE__, __LINE__);
			return ['status' => 0, 'info' => 'Operation failed.'];
		}
	}

}
<?php

declare(strict_types=1);
namespace Bullnet\Models;
use Bullnet\Database\{Query, Model};



class Users extends Model
{

    /**
     * @var string
     */
    private static $table = 'users';

    /**
     * @return void
     */
	public function __construct()
	{
		parent::__construct();
	}
    
    /**
     * @param $fields
     */
    public static function signup(array $fields) : ?object
    {
        try {
            $table = self::$table;
            return (new Query($table))->insert($fields)->run();
        } catch (Exception $exception) {
            Logger::log("SIGNUP QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
            return null;
        }
    }

    /**
     * @return object || null
     */
    public static function collect() : ?object
    {
        try {
            $table = self::$table;
            return Query::all()->from(self::$table)->where(['id', '>=', '6'])->and(['email', '=', 'emal@email.com'])->and(['status', '=', 'active'])->groupby('id')->orderby('id')->asc()->limit(7)->offset(3)->run();
        } catch (Exception $exception) {
            Logger::log("JOIN QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
            return null;
        }
    }

}
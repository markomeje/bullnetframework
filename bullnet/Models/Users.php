<?php

declare(strict_types=1);
namespace Bullnet\Models;
use Bullnet\Database\{Query, Model};
use Bullnet\Core\Logger;



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
            return (new Query($table))->insert($fields)->execute()->count();
        } catch (Exception $exception) {
            Logger::log("SIGNUP QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
            return null;
        }
    }

    /**
     * @return array || null
     */
    public static function collect()
    {
        try {
            $table = self::$table;
            return Query::all()->from(self::$table)->where(['email', '!=', ''])->and(['role', '!=', 'admin'])->and(['status', '=', 'active'])->orderby('id')->asc()->execute()->fetch()->all;
        } catch (Exception $exception) {
            Logger::log("USERS COLLECT QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
            return null;
        }
    }

    /**
     * @return object || null
     */
    public static function unique()
    {
        try {
            $table = self::$table;
            return Query::distinct('role')->from(self::$table)->orderby('role')->desc()->execute()->fetch()->all;
        } catch (Exception $exception) {
            Logger::log("USERS COLLECT QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
            return null;
        }
    }

    public static function update()
    {
        try {
            $table = self::$table;
            return Query::update(self::$table)->set(['updated' => time(), 'password' => $password])->where(['id', '!=', 34])->execute()->count();
        } catch (Exception $exception) {
            Logger::log("USERS COLLECT QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
            return null;
        }
    }

    /**
     * @return array || null
     */
    public static function join()
    {
        try {
            throw new \Exception("Error Processing Request", 1);
            
            $table = self::$table;
            return Query::select(["$table.*", 'comments.comment', 'comments.userid'])->from($table)->join('comments')->on(['comments.userid' => "$table.id"])->where(['email', '!=', ''])->and(['role', '!=', 'admin'])->and(['status', '!=', 'active'])->orderby('id')->asc()->execute()->fetch()->all;
        } catch (Exception $exception) {
            Logger::log("USERS COLLECT QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
            return null;
        }
    }

}
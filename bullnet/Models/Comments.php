<?php

declare(strict_types=1);
namespace Bullnet\Models;
use Bullnet\Database\{Query, Model, Database};



class Comments extends Model
{

    /**
     * @var string
     */
    private static $table = 'comments';

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
    public static function create(array $fields) : ?object
    {
        try {
            $table = self::$table;
            return Database::table(self::$table)->insert($fields)->execute();
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
            $result = Query::all()->from(self::$table)->where(['comment', '!=', ''])->and(['userid', '!=', 'null'])->orderby('id')->asc()->execute();
            return $result->fetch()->all;
        } catch (Exception $exception) {
            Logger::log("COMMENTS COLLECT QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
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
            $table = self::$table;
            return Query::all()->from(self::$table)->join('comments')->on(['comments.id' => 'userid.comments'])->where(['email', '!=', ''])->and(['role', '!=', 'admin'])->and(['status', '!=', 'active'])->orderby('id')->asc()->execute();
        } catch (Exception $exception) {
            Logger::log("USERS COLLECT QUERY ERROR", $exception->getMessage(), __FILE__, __LINE__);
            return null;
        }
    }

}
<?php declare(strict_types=1);

namespace Bullnet\Models;
use Bullnet\Core\{Model, Logger};
use Bullnet\Library\{Database, Generate};
use Bullnet\Http\Cookie;
use \Exception;


class Rememberme extends Model {
    
    /**
     * @var string
     */
    private static $table = 'rememberme';


    public function __construct() {}


    public static function remove($userid) {
        try {
            if(Cookie::exists(REMEMBER_ME_COOKIE_NAME) === true) Cookie::destroy(REMEMBER_ME_COOKIE_NAME, time() - REMEMBER_ME_COOKIE_EXPIRY);
            $table = self::$table;
            $database = Database::connect();
            $database->query("DELETE FROM {$table} WHERE userid = :userid", ['userid' => $userid]);
            return $database->rowCount() > 0;
        } catch (Exception $error) {
            Logger::log("REMOVING REMEMBER ME DETAILS ERROR", $error->getMessage(), __FILE__, __LINE__);
            return false;
        }
    }

    public static function log($userid) {
        try {
            self::remove($userid);
            $database = Database::connect();
            $table = self::$table;
            $token = Generate::string(64);
            Cookie::set(REMEMBER_ME_COOKIE_NAME, $token, time() + REMEMBER_ME_COOKIE_EXPIRY);
            $database->query("INSERT INTO {$table} (userid, token, expiry, iat) VALUES(:userid, :token, :expiry, :iat)", ['userid' => $userid, 'token' => $token, 'expiry' => REMEMBER_ME_COOKIE_EXPIRY, 'iat' => time()]);
            return $database->rowCount() > 0;
        } catch (Exception $error) {
            Logger::log("SETTING REMEMBER ME ERROR", $error->getMessage(), __FILE__, __LINE__);
            return false;
        }
    }

    public static function find($token) {
        try {
            $table = self::$table;
            $database = Database::connect();
            $database->query("SELECT * FROM {$table} WHERE token = :token LIMIT 1", ['token' => $token]);
            return $database->fetch();
        } catch (Exception $error) {
            Logger::log("FINDING REMEMBER ME DETAILS ERROR", $error->getMessage(), __FILE__, __LINE__);
            return false;
        }
    }

}
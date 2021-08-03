<?php declare(strict_types=1);

namespace Bullnet\Models;
use Bullnet\Core\Model;
use Bullnet\Library\{Database};


class Activity extends Model {
    
    /**
     * @var string
     */
    private static $table = 'activity';

    /**
     * @var int
     */
    private static $userid;

    /**
     * @var string
     */
    private static $ip;

    /**
     * @var string
     */
    private static $browser;

    /**
     * @var int
     */
    private static $timestamp;


    public function __construct($userid = 0, $ip = null, $browser = '', $timestamp = 0) {
        self::$userid = $userid;
        self::$ip = $ip;
        self::$browser = $browser;
        self::$timestamp = $timestamp;
    }

    public static function log($info) {
        try {
            $database = Database::connect();
            $table = self::$table;
            $database->query("INSERT INTO {$table} (userid, ip, browser, timestamp, type) VALUES(:userid, :ip, :browser, :timestamp, :type)", $info);
            return $database->rowCount() > 0;
        } catch (Exception $error) {
            Logger::log("ADDING ACTIVITY ERROR", $error->getMessage(), __FILE__, __LINE__);
            return false;
        }
    }

}
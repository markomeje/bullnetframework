<?php


declare(strict_types=1);
namespace Bullnet\Database;
use Bullnet\Core\{Logger, Config};
use Bullnet\Interfaces\ConnectionInterface;
use \Exception;
use \PDO;

class Connection implements ConnectionInterface
{

    /**
     * @var object 
     */
    private static $instance = null;

    /**
     * @var object 
     */
    public $pdo;

     /**
      * Database connection constructor
      * @return void
      */
    public function __construct() 
    {
        try{
            if(Config::get('ENVIROMENT') === 'development') {
                $credentials = (object)['dbname' => Config::get('LOCAL_DATABASE_NAME'), 'host' => Config::get('LOCAL_DATABASE_HOST'), 'charset' => Config::get('LOCAL_DATABASE_CHARSET'), 'username' => Config::get('LOCAL_DATABASE_USERNAME'), 'password' => Config::get('LOCAL_DATABASE_PASSWORD')];
            }elseif(Config::get('ENVIROMENT') === 'production') {
                $credentials = (object)['dbname' => Config::get('LIVE_DATABASE_NAME'), 'host' => Config::get('LIVE_DATABASE_HOST'), 'charset' => Config::get('LIVE_DATABASE_CHARSET'), 'username' => Config::get('LIVE_DATABASE_USERNAME'), 'password' => Config::get('LIVE_DATABASE_PASSWORD')];
            }else {
                exit('Invalid enviroment set. Please set either `production` or `development` as enviroment in .env file.');
            }
            
            $dsn = $connect = "mysql:dbname={$credentials->dbname};host={$credentials->host};charset={$credentials->charset}";
            $this->pdo = new PDO($dsn, $credentials->username, $credentials->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(Exception $exception) {
            Logger::log("DATABASE CONNECTION ERROR", $exception->getMessage(), __FILE__, __LINE__);
        }
    }

    /**
     * Open connection with singleton pattern
     * @return object || null
     */
    public static function open() : ?object
    {
        return self::$instance === null ? (new Connection()) : self::$instance;
    }

    /**
     * Close connection
     * @return void
     */
    public function close() : void
    {
        if(isset(self::$instance)) {
            self::$instance = null;
            $this->pdo = null;
        }
    }

    /**
     * @return PDO
     */
    public function pdo() : PDO
    {
        return $this->pdo;
    }

}
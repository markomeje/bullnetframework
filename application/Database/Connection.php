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
     * Implements the singleton pattern
     */
    private $instance = null;

    /**
     * @var object 
     */
    private $pdo;

     /**
      * Database connection constructor
      */
    public function __construct() 
    {
        try{
            if(Config::get('ENVIROMENT') === 'development') {
                $credentials = (object)['dbname' => Config::get('LOCAL_DATABASE_NAME'), 'host' => Config::get('LOCAL_DATABASE_HOST'), 'charset' => Config::get('LOCAL_DATABASE_CHARSET'), 'username' => Config::get('LOCAL_DATABASE_USERNAME'), 'password' => Config::get('LOCAL_DATABASE_PASSWORD')];
            }else {
                $credentials = (object)['dbname' => Config::get("LIVE_DATABASE_NAME"), 'host' => Config::get("LIVE_DATABASE_HOST"), 'charset' => Config::get("LIVE_DATABASE_CHARSET"), 'username' => Config::get("LIVE_DATABASE_USERNAME"), 'password' => Config::get("LIVE_DATABASE_PASSWORD")];
            }
            
            $dsn = $connect = "mysql:dbname={$credentials->dbname};host={$credentials->host};charset={$credentials->charset}";
            $this->pdo = new PDO($dsn, $credentials->username, $credentials->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(Exception $exception) {
            Logger::log("PDO CONNECTION ERROR", $exception->getMessage(), __FILE__, __LINE__);
        }
    }

    /**
     * Open connection
     * @return object
     */
    public function open() : object
    {
        $this->instance === null ? (new Connection()) : $this->instance;
        return $this;
    }

    /**
     * @return PDO
     */
    public function pdo() : PDO
    {
        return $this->pdo;
    }

    /**
     * Close connection
     * @return void
     */
    public function close() : void
    {
        if(isset($this->instance)) {
            $this->instance = null;
            $this->pdo = null;
        }
    }

}
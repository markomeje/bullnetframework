<?php
declare(strict_types=1);

namespace Bullnet\Database;
use Bullnet\Core\{Logger, Config};
use \Exception;
use \PDO;

class Database 
{

    /**
     * @var object
     */
    private static $instance = null;

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var object
     */
    private $statement;

    /**
     * Database Constructor
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
     * Opens database connection
     * @return object
     */
    public static function connect() : object
    {
        return self::$instance === null ? (new self()) : self::$instance;
    }

    /**
     * @return Transaction
     */
    public function transaction() : Transaction
    {
        return (new Transaction(self::connect()));
    }
    
    /**
     * @param $sql
     * @return object
     */
    public function prepare(string $sql) : object
    {
        $this->statement = $this->pdo->prepare($sql);
        return $this;
    }

    /**
     * @param $fields array
     * @return object
     */
    public function execute(array $fields) : object
    {
        if (!isset($this->statement)) throw new DatabaseException('You must call prepare before trying to execute a prepared statement.');
        empty($fields) ? $this->statement->execute() : $this->statement->execute(array_values($fields));
        return $this;
    }

    /**
     * Returns the id of the last inserted row
     * @return integer
     */
    public function id() 
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * To fetch Only all rows matched
     * @return array
     */
    public function all() 
    {
        return $this->statement->fetchAll();
    }
    
    /**
     * To fetch Only a single row
     * @return array or bool
     */
    public function fetch() 
    {
        return $this->statement->fetch();
    }
    
    /**
     * To find the number of rows affected by the last SQL statement
     * @access public
     */
    public function count() 
    {
        return $this->statement->rowCount();
    }

    /**
     * Close connection
     * @return void
     */
    public function disconnect() : void
    {
        if(isset($this->instance)) {
            $this->instance = null;
            $this->pdo = null;
        }
    }

}
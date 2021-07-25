<?php
declare(strict_types=1);

namespace Bullnet\Library;
use Bullnet\Core\Logger;
use \Exception;
use \PDO;

class Database {
    
    /**
     * @access private
     * @var PDO PDO Object [default = null]
     */
    private $pdo = null;

    /**
     * @access private
     * @var PDOStatement PDOStatement Object
     */
    private $statement = null;

    /**
     * @access private
     * @static static
     * 
     * @var Database Database Object used to implement the Singleton pattern
     */
    private static $instance = null;

     /**
      * Database Constructor for instant connection
      *
      * @return object
      * 
      */
    public function __construct() {
        try{ 
            if (ENVIROMENT === 'development') {
                $connect = 'mysql:dbname='.LOCAL_DATABASE_NAME.';host='.LOCAL_DATABASE_HOST.';charset='.LOCAL_DATABASE_CHARSET;
                $this->pdo = new PDO($connect, LOCAL_DATABASE_USERNAME, LOCAL_DATABASE_PASSWORD);
            }else {
                $connect = 'mysql:dbname='.LIVE_DATABASE_NAME.';host='.LIVE_DATABASE_HOST.';charset='.LIVE_DATABASE_CHARSET;
                $this->pdo = new PDO($connect, LIVE_DATABASE_USERNAME, LIVE_DATABASE_PASSWORD);
            }
            
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }catch(Exception $error) {
            Logger::log("DATABASE CONNECTION ERROR", $error->getMessage(), __FILE__, __LINE__);
            return false;
        }
    }

    /**
     * Singleton design pattern - It creates the database instance once and reuses it
     *
     * @return database object [PDO]
     * @access public
     * @static static method
     * 
     */
    public static function connect() {
        return self::$instance === null ? (new self()) : self::$instance;
    }
    
    /**
     * Prepares an SQL query and executes
     *
     * @param  string  $sql
     * @param  array  $fields
     *
     */
    public function query($sql, $fields = []) {
        $this->statement = $this->pdo->prepare($sql);
        empty($fields) ? $this->statement->execute() : $this->statement->execute($fields);
        return $this;
    }

    /**
     * Start a transaction
     *
     * @access public
     * @return  boolean [TRUE on success or FALSE on failure.]
     * 
     */
    public function beginTransaction() {
        $this->pdo->beginTransaction();
    }

    /**
     * Commits a transaction
     * @return [boolean] [TRUE on success or FALSE on failure.]
     */
    public function commit() {
        $this->pdo->commit();
    }

    /**
     * Rolls back the current transaction, as initiated by PDO::beginTransaction().
     * A PDOException will be thrown if no transaction is active.
     * 
     * @return [boolean] [It will return the database connection to autocommit 
     * mode until the next call to PDO::beginTransaction() starts a new transaction.]
     */
    public function rollback() {
        $this->pdo->rollBack();
    }

    /**
     * To fetch the result data in form of [0-indexed][key][value] array.
     *
     * @access public
     * @return array empty array if no data returned
     */
    public function all() {
        return $this->statement->fetchAll();
    }
    
    /**
     * To fetch Only the next row from the result data in form of [key][value] array.
     *
     * @access public
     * @return array or bool-False on if no data returned
     */
    public function fetch() {
        return $this->statement->fetch();
    }
    
    /**
     * Returns the id of the last inserted row
     *
     * @access public
     * @return integer-The ID of the last inserted row of Auto-incremented primary key.
     */
    public function id() {
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Returns the number of rows affected by the last SQL statement
     *
     * @access public
     */
    public function count() {
        return $this->statement->rowCount();
    }
    
    /**
     * Closing the connection.
     *
     * It's not necessary to close the connection, however it's a good practice.
     *If you don't do this explicitly, PHP will automatically close the connection when your script ends.
     *
     * This will be used at the end "footer.php"
     *
     * @static static method
     * @access public
     */
    public static function disconnect() {
        if(isset(self::$instance)) {
            self::$instance->pdo = null;
            self::$instance->statement = null;
            self::$instance = null;
        }
    }

}
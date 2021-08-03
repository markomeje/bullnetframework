<?php


declare(strict_types=1);
namespace Bullnet\Database;
use Bullnet\Database\Query;
use \Exception;


class Database 
{

    /**
     * @var object
     */
    private $connection = null;

    /**
     * @var object
     */
    private $transaction;

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
     * @return void
     */
    public function __construct() 
    {
        $this->connection = Connection::open();
        $this->pdo = $this->connection->pdo();
    }

    /**
     * @return Transaction
     */
    public function transaction() : Transaction
    {
        $this->transaction = (new Transaction($this->pdo));
        return $this;
    }
    
    /**
     * @param string $sql
     * @return object
     */
    public function prepare(string $sql) : object
    {
        $this->statement = $this->pdo->prepare($sql);
        return $this;
    }

    /**
     * @param array $fields
     * @return object
     */
    public function execute(array $fields) : object
    {
        if (!isset($this->statement)) {
            throw new Exception('You must call prepare before trying to execute a prepared statement.');
        }

        empty($fields) ? $this->statement->execute() : $this->statement->execute(array_values($fields));
        return $this;
    }

    /**
     * Returns the id of the last inserted row
     * @return int
     */
    public function id() : int 
    {
        return $this->pdo->lastInsertId();
    }
    
    /**
     * To fetch Only a single row
     * @return object
     */
    public function fetch() : object
    {
        return (object)['one' => $this->statement->fetch(), 'all' => $this->statement->fetchAll()];
    }
    
    /**
     * To find the number of rows affected by the last SQL statement
     * @return int
     */
    public function count() : int 
    {
        return $this->statement->rowCount();
    }

    /**
     * @param string $table
     * @return Query
     */
    public static function table(string $table) : Query
    {
        return (new Query($table));
    }

}
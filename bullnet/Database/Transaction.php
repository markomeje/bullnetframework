<?php

declare(strict_types=1);
namespace Bullnet\Database;
use \PDO;


class Transaction 
{

    /**
     * @var object
     */
    private $transaction;

    /**
     * @return void
     */
    public function __construct(PDO $pdo)
    {
        $this->transaction = $pdo;
    }

    /**
     * Start a transaction
     * @return  boolean
     */
    public function begin() : bool 
    {
        return $this->transaction->beginTransaction();
    }
    
    /**
     * Rolls back the current transaction
     * @return boolean
     */
    public function rollback() : bool
    {
        return $this->transaction->rollBack();
    }

    /**
     * Commits a transaction
     * @return boolean
     */
    public function commit() : bool
    {
        $this->transaction->commit();
    }

}
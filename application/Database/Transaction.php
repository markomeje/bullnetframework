<?php

declare(strict_types=1);

namespace Bullnet\Databse;
use Bullnet\Database\Databse;


class Transaction 
{

    /**
     * @var object
     */
    private $transaction;

    /**
     * @return void
     */
    public function __construct(Database $database) : void
    {
        $this->transaction = $database->connection->pdo();
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
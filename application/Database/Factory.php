<?php

declare(strict_types=1);

namespace Bullnet\Database;
use Bullnet\Database\Database;


class Factory
{
    

    /**
     * @var array
     */
    private $fields;

    /**
     * @var string
     */
    protected $sql;


    /**
     * @return void
     */
    public function __construct(string $sql, array $fields) 
    {
        $this->sql = $sql;
        $this->fields = $fields;
    }

    /**
     * Runs SQL Queries
     * @return Database object
     */
    public function create() : Database
    {
        $database = \Bullnet\Database\Database::connect();
        return $database->prepare($this->sql)->execute($this->fields);
    }

}
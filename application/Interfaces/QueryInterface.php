<?php

declare(strict_types=1);
namespace Bullnet\Interfaces;


Interface QueryInterface
{

    /**
     * Insert operation
     * @param $fields
     * @return object
     */
    public function insert(array $fields) : object;

    /**
     * Orderby clause
     * @param $orderby
     * @return self
     */
    // public function orderby(array $orderby) : self;

    // /**
    //  * Delete operation
    //  * @return self
    //  */
    // public function delete() : self;

    // /**
    //  * Select form table
    //  * @param $table
    //  * @return self
    //  */
    // public function from(string $table) : self;

    // /**
    //  * Select clause
    //  * @param $data
    //  * @return self
    //  */
    // public function select($data) : self;

    // /**
    //  * Limit clause
    //  * @param $limit
    //  * @return self
    //  */
    // public function limit(int $limit = 1) : self;

}
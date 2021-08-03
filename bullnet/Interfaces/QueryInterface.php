<?php

declare(strict_types=1);
namespace Bullnet\Interfaces;


Interface QueryInterface
{

    /**
     * Insert operation
     * @param array $fields
     * @return object
     */
    public function insert(array $fields);

    /**
     * Orderby clause
     * @param string $column
     * @return object
     */
    public function orderby(string $column);

    /**
     * Delete operation
     * @return object
     */
    public static function delete();

    /**
     * Select form table
     * @param string $table
     * @return object
     */
    public function from(string $table);

    /**
     * Select clause
     * @param string || array $data
     * @return object
     */
    public static function select($data);

    /**
     * Limit clause
     * @param int $limit
     * @return object
     */
    public function limit(int $limit);

}
<?php


declare(strict_types=1);
namespace Bullnet\Interfaces;


interface ConnectionInterface
{

    /**
     * Opens connection
     * @return object || null
     */
    public static function open() : ?object;

    /**
     * Close connection
     * @return void
     */
    public function close() : void;

}
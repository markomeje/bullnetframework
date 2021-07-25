<?php
declare(strict_types=1);

namespace Bullnet\Interfaces;
use \Exception;
use \PDO;

interface ConnectionInterface
{

    /**
     * Opens connection
     * @return object
     */
    public function open() : object;

    /**
     * Close connection
     * @return void
     */
    public function close() : void;

}
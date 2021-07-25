<?php

declare(strict_types=1);
namespace Bullnet\Database\Query;


class Crud
{

    /**
     * @var array
     */
    protected static $parts = ['create' => 'INSERT', 'read' => 'SELECT', 'update' => 'UPDATE', 'delete' => 'DELETE'];

}
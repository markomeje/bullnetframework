<?php

declare(strict_types=1);
namespace Bullnet\Database;
use Bullnet\Interfaces\ModelInterface;


abstract class Model implements ModelInterface
{

    /**
     * @var string
     */
    private static $table;

    /**
     * Model constructor inherited by all models
     * @return void
     */
	public function __construct()
	{}

}

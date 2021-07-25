<?php

declare(strict_types=1);
namespace Bullnet\Database\Query;


class Operators
{


    /**
     * @var array
     */
    private $operands = [
        'and',
        '=',
        'or',
        '>=',
        'like',
        '<',
        '>',
        '<='
    ];

    /**
     * @var string
     */
    private $part;

	/**
     * @return void
     */
    public function __construct()
    {}

    public function add() : object
    {}

}
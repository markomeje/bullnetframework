<?php

namespace Bullnet\Database;
use Bullnet\Core\{Logger};
use Bullnet\Database\{Runner, Query};


class Placeholder
{
    
    /**
     * @var string
     */
	private $key;

    /**
     * @var string
     */
    private $holder = '?';


    /**
     * Model constructor inherited by all models
     * @return void
     */
	public function __construct()
	{}
    
    /**
     * Set positional placeholders with key
     * @param $operand
     * @return string
     */
    public function build(string $key, string $operand = '') : string
    {
        $holder = $this->holder;
        return "{$key} {$operand} {$holder}";
    }
    
    /**
     * Model constructor inherited by all models
     * @param $key
     * @param $fields
     */
    public function set() : string
    {
        return $this->holder;
    }

}

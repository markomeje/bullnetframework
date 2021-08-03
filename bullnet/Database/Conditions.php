<?php

declare(strict_types=1);
namespace Bullnet\Database;
use \Exception;


class Conditions
{

    /**
     * @var mixed
     */
    public $value;

    /**
     * @var array
     */
    public $condition;

    /**
     * @var string
     */
    public $column;

    /**
     * @var string
     */
    public $operand;

    /**
     * @param array $condition
     * @return void
     */
    public function __construct(array $condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return self
     */
    public function build() : self
    {
        if (empty($this->condition) || count($this->condition) !== 3) {
            throw new Exception('Invalid arguments passed to Where clause.');
        }

        [$this->column, $this->operand, $this->value] = $this->condition;
        if (stripos(strtolower($this->operand), 'like') !== false) {
            $this->value = "%$this->value%";
        }

        return $this;
    }

}
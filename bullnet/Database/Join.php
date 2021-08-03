<?php

declare(strict_types=1);
namespace Bullnet\Database;


class Join
{

    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    public $query;

    /**
     * Join constructor
     */
    public function __construct(string $table) 
    {
        $this->table = $table;
    }

    /**
     * @param array $fields
     * @return self
     */
    public function on(array $fields) : self
    {
        $template = "ON %s";
        foreach ($fields as $key => $value) {
            $join[] = "$key = $value";
        }

        $joined = implode(' ', $join);
        $this->query = sprintf($template, $joined);
        return $this;
    }

    /**
     * Join clause
     */
    public function join() : self
    {
        $template = "JOIN %s";
        $this->query = sprintf($template, $this->table);
        return $this;
    }

}
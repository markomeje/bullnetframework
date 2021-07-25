<?php

declare(strict_types=1);
namespace Bullnet\Database\Query;
use Bullnet\Database\Query;


class Join
{

    /**
     * @var string
     */
    private $table;

    /**
     * @var array
     */
    private $query;

    /**
     * @var string
     */
    private $joined;

    /**
     * Join constructor
     */
    public function __construct($query, string $table) 
    {
        $this->query = $query;
        $this->table = $table;
    }

    /**
     * Join on clause
     * @param $fields
     * @return Query
     */
    public function on(array $fields) : Query
    {
        $this->join();
        $template = "ON %s";
        foreach ($fields as $key => $value) {
            $join = "$key = $value";
        }

        $query = $this->query;
        $this->joined[] = sprintf($template, $join);
        var_dump($query->sql, 'Here');
        // array_push($this->joined, $this->query->sql);
        // array_merge([$this->query->sql], $this->joined);
        return $this->query;
    }

    /**
     * Join clause
     */
    private function join() : self
    {
        $template = "JOIN %s";
        $this->joined[] = sprintf($template, $this->table);
        return $this;
    }

}
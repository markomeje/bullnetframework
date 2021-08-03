<?php

declare(strict_types=1);
namespace Bullnet\Database;
use Bullnet\Interfaces\QueryInterface;
use Bullnet\Core\Logger;
use \Exception;


class Query implements QueryInterface
{

    /**
     * @var array
     */
    protected static $fields = [];
    
    /**
     * @var string || array
     */
    public static $sql;

    /**
     * @var array
     */
    protected static $conditions = [];

    /**
     * @var string
     */
    public static $table;

    /**
     * @var int
     */
    private $offset;

    /**
     * Positional placeholder string
     * @var string
     */
    private static $holder = '?';

    /**
     * Join query
     * @var string
     */
    private $join;

    /**
     * Limit value
     * @var int
     */
    private $limit;

    /**
     * Query constructor with optional args
     * @param $table | string
     * @param $fields | array
     * @return void
     */
    public function __construct(string $table = '', array $fields = [])
    {
        self::$table = $table;
        self::$fields = $fields;
    }

    /**
     * @param string $table
     * @return self
     */
    public static function table(string $table) : self
    {
        return self::self($table);
    }

    /**
     * Query instance
     * @return self
     */
    public static function self(string $table = '') : self
    {
        return (new self($table));
    }

    /**
     * Insert operation
     * @param array $fields
     * @return self
     */
    public function insert(array $fields) : object
    {
        $template = "INSERT INTO %s (%s) VALUES (%s)";
        self::$fields = $fields;
        $keys = array_keys($fields);
        $columns = implode(', ', $keys);

        foreach ($keys as $key){
            $holders[] = self::$holder;
        }

        $placeholders = implode(', ', $holders);
        self::$sql = sprintf($template, self::$table, $columns, $placeholders);
        return $this;    
         
    }
    
    /**
     * Run database query
     * @return Database object
     */
    public function execute() : Database
    {
        $query = self::$sql;
        if (is_array($query)) {
            $query = implode(' ', $query);
        }

        $fields = array_merge(self::$fields, self::$conditions);
        return (new Factory($query, $fields))->create();
    }

    /**
     * Update operation
     * @param string $table
     * @return object
     */
    public static function update(string $table) : object 
    {
        self::$table = $table;
        $template = "UPDATE %s";
        self::$sql[] = sprintf($template, $table);
        return self::self();
    }
    
    /**
     * Set update fields
     * @param $fields | array
     * @return self
     */
    public function set(array $fields) : self
    {
        $template = "SET %s";
        self::$fields = $fields;
        foreach ($fields as $key => $value){
            $holder = self::$holder;
            $holders[] = "$key = $holder";
        }

        $placeholders = implode(', ', $holders);
        self::$sql[] = sprintf($template, $placeholders);
        return $this;
    }

    /**
     * Offset clause
     * @param $offset | int
     * @return self
     */
    public function offset(int $offset = 0) : self 
    {
        $this->offset = $offset;
        $template = "OFFSET %s";
        self::$sql[] = sprintf($template, $this->offset);
        return $this;
    }

    /**
     * Where clause
     * @param $condition | array
     * @return self
     */
    public function where(array $condition) : self 
    {
        $build = (new Conditions($condition))->build();
        $template = "WHERE %s %s %s";
        self::$conditions = [$build->column => $build->value];
        self::$sql[] = sprintf($template, $build->column, strtoupper($build->operand), self::$holder);
        return $this;
    }

    /**
     * Where AND clause
     * @return self
     */
    public function and(array $condition) : self 
    {
        $build = (new Conditions($condition))->build();
        $template = "AND %s %s %s";
        self::$conditions = array_merge(self::$conditions, [$build->column => $build->value]);
        self::$sql[] = sprintf($template, $build->column, strtoupper($build->operand), self::$holder);
        return $this;
    }

    /**
     * Select all
     * @return self
     */
    public static function all() : self 
    {
        return self::select("*");
    }

    /**
     * Where OR clause
     * @param $condition | array
     * @return self
     */
    public function or(array $condition) : self 
    {
        $build = (new Conditions($condition))->build();
        $template = "OR %s %s %s";
        self::$conditions = array_merge(self::$conditions, [$build->column => $build->value]);
        self::$sql[] = sprintf($template, $build->column, strtoupper($build->operand), self::$holder);
        return $this;
    }

    /**
     * Limit clause
     * @param $limit | int
     * @return self
     */
    public function limit(int $limit = 1) : self 
    {
        $this->limit = (int)$limit;
        $template = "LIMIT %s";
        self::$sql[] = sprintf($template, $this->limit);
        return $this;
    }

    /**
     * Select clause
     * @param string || array $data
     * @return self
     */
    public static function select($data) : self 
    {
        if (is_string($data)) {
            $fields = $data;
        }else {
            $fields = implode(', ', $data);
            self::$fields = $fields;
        }
        
        $template = "SELECT %s";
        self::$sql[] = sprintf($template, $fields);
        return static::self();
    }

    /**
     * Select distinct clause
     * @param string $column
     * @return self
     */
    public static function distinct(string $column) : self 
    {
        $template = "SELECT DISTINCT %s";
        self::$sql[] = sprintf($template, $column);
        return static::self();
    }

    /**
     * Delete clause
     * @return self
     */
    public static function delete() : self 
    {
        self::$sql[] = "DELETE";
        return static::self();
    }

    /**
     * Select form table
     * @param string $table
     * @return self
     */
    public function from(string $table) : self 
    {
        self::$table = $table;
        $template = "FROM %s";
        self::$sql[] = sprintf($template, $table);
        return $this;
    }

    /**
     * Orderby clause
     * @param string $column
     * @return self
     */
    public function orderby(string $column) : self 
    {
        $template = "ORDER BY %s";
        self::$sql[] = sprintf($template, $column);
        return $this;
    }

    /**
     * Join clause
     * @param $table | string
     * @return self
     */
    public function join(string $table)
    {
        $this->join = (new Join($table));
        self::$sql[] = $this->join->join()->query;
        return $this;
    }

    /**
     * Join on clause
     * @param array $fields
     * @return self
     */
    public function on(array $fields) : self 
    {
        self::$sql[] = $this->join->on($fields)->query;
        return $this;
    }

    /**
     * Groupby clause
     * @param $column
     * @return self
     */
    public function groupby(string $column) : self 
    {
        $template = "GROUP BY %s";
        self::$sql[] = sprintf($template, $column);
        return $this;
    }

    /**
     * Orderby direction descending
     * @return self
     */
    public function desc() : self 
    {
        self::$sql[] = strtoupper('desc');
        return $this;
    }

    /**
     * Having clause
     * @param $condition | array
     * @return self
     */
    public function having(array $condition) : self 
    {
        if (!is_array($condition) || count($condition) !== 3) {
            throw new Exception('Invalid arguments passed to Having clause.');
        }

        $template = "HAVING %s";
        $having = implode(' ', $condition);
        self::$sql[] = sprintf($template, $having);
        return $this;
    }

    /**
     * Orderby direction ascending
     * @return self
     */
    public function asc() : self 
    {
        self::$sql[] = strtoupper('asc');
        return $this;
    }

}
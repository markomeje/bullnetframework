<?php

declare(strict_types=1);
namespace Bullnet\Database;
use Bullnet\Interfaces\QueryInterface;
use Bullnet\Database\Database;
use Bullnet\Database\Query\Crud;
use Bullnet\Core\Logger;
use \Exception;


class Query extends Crud implements QueryInterface
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
     * Check for querying more than one table
     * False means single table
     * @var boolean
     */
    private $multiple;

    /**
     * Order By [ASC || DESC]
     * @var array
     */
    private $directions = ['asc', 'desc'];

    /**
     * @var int
     */
    private $offset;

    /**
     * @var string
     */
    private static $holder = '?';

    /**
     * @param $table
     * @param $fields
     */
    public function __construct(string $table = '', array $fields = [])
    {
        self::$table = $table;
        self::$fields = $fields;
    }

    /**
     * Class instance
     * @return self
     */
    public static function self() : self
    {
        return new self;
    }

    /**
     * Insert query 
     * @return object
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
     * Select options 
     * @return object
     */
    public function options(array $fields) : ?object 
    {
        $template = "INSERT INTO %s (%s) VALUES (%s)";
        $placeholders = implode(', ', $holders);
        self::$sql[] = sprintf($template, self::$table, $columns, $placeholders);
        return $this;    
         
    }
    
    /**
     * Run database query
     * @return Database object
     */
    public function run()
    {
        $query = self::$sql;
        if (is_array($query)) {
            $query = implode(' ', $query);
        }

        $fields = array_merge(self::$fields, self::$conditions);
        return (new \Bullnet\Database\Factory($query, $fields))->create();
    }

    /**
     * Update operation
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
     * Set fields
     * @return self
     */
    public function set(array $fields = ['id' => $id, 'name' => 'markomeje']) : self
    {
        $template = "SET %s";
        self::$fields = $fields;
        foreach ($fields as $key => $value){
            $holders[] = "$key = self::$holder";
        }

        $placeholders = implode(', ', $holders);
        self::$sql[] = sprintf($template, $placeholders);
        return $this;
    }

    /**
     * Offset clause
     * @return self
     */
    public function offset(int $offset = 0) : self 
    {
        $template = "OFFSET %s";
        self::$sql[] = sprintf($template, $offset);
        return $this;
    }

    /**
     * Where clause
     * @return self
     */
    public function where(array $condition) : self 
    {
        if (!is_array($condition) || count($condition) !== 3) {
            throw new Exception('Invalid arguments passed to where clause');
        }

        $template = "WHERE %s %s %s";
        [$column, $operand, $value] = $condition;
        self::$conditions = [$column => $value];

        self::$sql[] = sprintf($template, $column, $operand, self::$holder);
        return $this;
    }

    /**
     * Where AND clause
     * @return self
     */
    public function and(array $condition) : self 
    {
        if (!is_array($condition) || count($condition) !== 3) {
            throw new Exception('Invalid arguments passed to where clause');
        }

        $template = "AND %s %s %s";
        [$column, $operand, $value] = $condition;
        self::$conditions = array_merge(self::$conditions, [$column => $value]);
        self::$sql[] = sprintf($template, $column, $operand, self::$holder);
        return $this;
    }

    /**
     * Select all
     * @return self
     */
    public static function all() : self 
    {
        return self::select('*');
    }

    /**
     * Limit clause
     * @param $limit
     * @return self
     */
    public function limit(int $limit = 1) : self 
    {
        $template = "LIMIT %s";
        self::$sql[] = sprintf($template, $limit);
        return $this;
    }

    /**
     * Select clause
     * @param $data
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
     * Select clause
     * @param $data
     * @return self
     */
    public function distinct(string $column) : self 
    {
        
        $template = "SELECT DISTINCT %s";
        self::$sql[] = sprintf($template, $column);
        return $this;
    }

    /**
     * Delete clause
     * @return self
     */
    public function delete() : self 
    {
        self::$sql[] = "DELETE";
        return $this;
    }

    /**
     * Select form table
     * @param $table string || array
     * @return self
     */
    public function from($table) : self 
    {
        self::$table = $table;
        $template = "FROM %s";
        self::$sql[] = sprintf($template, $table);
        return $this;
    }

    /**
     * Orderby clause
     * @param $column
     * @return self
     */
    public function orderby(string $column) : self 
    {
        $template = "ORDER BY %s";
        self::$sql[] = sprintf($template, $column);
        return $this;
    }

    /**
     * Find a record
     * @param $fields
     * @return self
     */
    public function find(array $conditions = []) : self 
    {
        return $this->all()->from()->where($conditions);
    }

    /**
     * Join clause
     * @param $table
     * @return self
     */
    public function join(string $table, Callable $callback = null)
    {
        $template = "JOIN %s";
        self::$sql[] = sprintf($template, $table);
        return $this;
    }

    /**
     * Join clause
     * @param $onfields
     * @return self
     */
    public function on(array $onfields) : self 
    {
        $template = "ON %s";
        foreach ($onfields as $key => $value) {
            $join = "$key = $value";
        }

        self::$sql[] = sprintf($template, $join);
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
     * Join clause direction
     * @return self
     */
    public function desc() : self 
    {
        self::$sql[] = strtoupper('desc');
        return $this;
    }

    /**
     * Search
     * @return self
     */
    public function search() : self 
    {
        self::$sql[] = strtoupper('asc');
        return $this;
    }

    /**
     * Join clause direction
     * @return self
     */
    public function asc() : self 
    {
        self::$sql[] = strtoupper('asc');
        return $this;
    }

    //$database->query("SELECT {$table}.*, categories.name as categoryname FROM {$table}, categories WHERE categories.id = {$table}.category ORDER BY date DESC LIMIT {$limit} OFFSET {$offset}");

}
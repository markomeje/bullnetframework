<?php

declare(strict_types=1);
namespace Bullnet\Core;
use \Exception;

/**
 * Config class.
 * Gets a configuration value
 */
class Config
{

    /**
     * Array of configurations
     * @var array
     */
    private static $config = [];

    /**
     * Get default configuration value(s)
     * @param $key string
     * @return string
     */
    public static function get(string $key) : ?string
    {
        $file = BULLNET_PATH . DS . 'config.php';
        if (!file_exists($file)) exit('Configuration file {$file} doesn\'t exist');
        self::$config = require $file;
        if (empty($key)) throw new Exception("Configuration can't be empty");
        return isset(self::$config[$key]) ? self::$config[$key] : null;

    }

}

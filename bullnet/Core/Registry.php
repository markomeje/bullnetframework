<?php

declare(strict_types=1);

namespace Bullnet\Core;


class Registry
{

	/**
	 * Store and retrives instances
	 * @var array
	 */
	private static $instances = [];

    /**
	 * Get instance
	 * @var array
	 * @return object || null
	 */
	public static function get($key) : ?object
	{
		return self::$instances[$key] ?? null;
	}

    /**
	 * Creates an instance
	 * @param string $key
	 * @param object $instance
	 * @return void
	 */
	public static function set(string $key, object $instance = null) : void
	{
	 	self::$instances[$key] = $instance;
	}

	/**
	 * Remove an instance
	 * @param string
	 */
	public static function erase($key) : void
	{
	 	unset(self::$instances[$key]);
	}

}


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
	 */
	public static function get($key) : mixed
	{
		return self::$instances[$key] ?? null;
	}

    /**
	 * Creates an instance
	 * @param string
	 * @param object
	 */
	public static function set($key, $instance = null) : void
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


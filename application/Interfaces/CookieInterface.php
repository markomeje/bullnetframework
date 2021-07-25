<?php 

declare(strict_types=1);
namespace Bullnet\Interfaces;


Interface CookieInterface
{
	/**
	 * Set cookie
	 * @param $name
	 * @param $value
	 * @param $expiry
	 */
	public static function set(string $name, string $value, int $expiry) : bool;
    
    /**
	 * Destroy cookie
	 * @param $name
	 * @param $expiry
	 */
	public static function destroy(string $name, int $expiry) : bool;
    
    /**
	 * Get cookie
	 * @param $name
	 */
	public static function get(string $name) : ?string;
    
    /**
	 * Check cookie exists
	 * @param $name
	 */
	public static function exists(string $name) : bool;

	/**
	 * Set cookie
	 * @param $name
	 * @param $value
	 */
	public static function reset(string $name, string $value) : bool;

}
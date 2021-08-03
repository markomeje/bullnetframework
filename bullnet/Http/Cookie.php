<?php 

declare(strict_types=1);
namespace Bullnet\Http;
use Bullnet\Interfaces\CookieInterface;


class Cookie implements CookieInterface
{
	/**
	 * Set cookie
	 * @param $name
	 * @param $value
	 * @param $expiry
	 */
	public static function set(string $name, string $value, int $expiry = 3600) : bool 
	{
		return setcookie($name, $value, $expiry, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE, COOKIE_HTTP);
	}
    
    /**
	 * Destroy cookie
	 * @param $name
	 * @param $expiry
	 */
	public static function destroy(string $name, int $expiry) : bool
	{
		return self::set($name, '', $expiry, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE, COOKIE_HTTP);
	}
    
    /**
	 * Get cookie
	 * @param $name
	 */
	public static function get(string $name) : ?string
	{
		return self::exists($name) ? $_COOKIE[$name] : null;
	}
    
    /**
	 * Check cookie exists
	 * @param $name
	 */
	public static function exists(string $name) : bool
	{
		return isset($_COOKIE[$name]);
	}

	/**
	 * Set cookie
	 * @param $name
	 * @param $value
	 */
	public static function reset(string $name, string $value) : bool
	{}


}
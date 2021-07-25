<?php declare(strict_types=1);

namespace Bullnet\Library;
use Bullnet\Http\Cookie;


class Session 
{

    /**
     * Start a new PHP session if it's not already started.
     * @return void
     */
	public static function start() : void
    {
		if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
	}

    /**
     * Checks if a session key exists
     * @param $key
     * @return bool
     */
    public static function exists(string $key) : bool
    {
        return (isset($_SESSION[$key])) ? true : false;
    }

    /**
     * Set a key
     * @param $key
     * @param $value
     */
    public static function set(string $key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    /**
     * Get a key from session
     * @param $key
     */
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }

    /**
     * Unsets an existing session key
     * @param $key
     * @return void
     */
    public static function delete(string $key) : void
    {
        if(self::exists($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroys a session with any session cookie
     * @return boolean
     */
    public static function destroy() : bool
    {
        if (ini_get("session.use_cookies")) {
            $values = session_get_cookie_params();
            Cookie::set(session_name(), '', time() - SESSION_COOKIE_EXPIRY, $values["path"], $values["domain"], $values["secure"], $values["httponly"]);
        }

        if(session_status() === PHP_SESSION_ACTIVE){
            session_destroy();
            return true;
        }
    }


}

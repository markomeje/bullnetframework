<?php

namespace Bullnet\Core;
use Bullnet\Core\Logger;
use \ErrorException;

 /**
  * Handler class.
  *
  * Provides basic error and exception handling for the application.
  * It captures and handles all unhandled exceptions and errors.
  *
  */

class Handler 
{

    /**
     * Register the error and exception handlers.
     * Must be called at the beginning of your application
     *
     * @return void
     */
    public static function register()
    {
        /**
         * Turn off error reporting cause it's handled.
         */
        error_reporting(0);
        set_error_handler(__CLASS__ . '::error');
        set_exception_handler(__CLASS__ .'::exception');
        register_shutdown_function(__CLASS__ .'::fatal');
    }

     /**
      * Handle fatal errors
      *
      * @return void
      */
    public static function fatal()
    {
        if (PHP_SAPI === 'cli') { return; }
        $error = error_get_last();
        if (!is_array($error)) { return; }
        $fatals = [E_USER_ERROR, E_ERROR, E_PARSE];
        if (!in_array($error['type'], $fatals, true)) {
            return;
        }
        self::exception(new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']));
    }

    /**
     * Handle errors
     *
     * @return void
     * @throws ErrorException
     */
    public static function error($error, $message, $file, $line, $vars)
    {
        throw new ErrorException($message, 0, $error, $file, $line);
    }

    /**
     * Handle & log exceptions
     * @param  Throwable  $error
     * @return void
     */
    public static function exception($error) 
    {
        Logger::Log(get_class($error), $error->getMessage(), $error->getFile(), $error->getLine());
    }

}

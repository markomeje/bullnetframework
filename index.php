<?php declare(strict_types=1);

use Bullnet\Core\{Logger, Config};
use Bullnet\Library\{Authenticated, Session};
use Bullnet\Http\Cookie;
use Bullnet\Models\Login;
use DI\Bridge\Slim\Bridge as SlimAppFactory;

/**
 * --------------------------------------------------
 * Declaring current time zone for accurate time logs
 * --------------------------------------------------
 */
date_default_timezone_set('Africa/Lagos');

/**
 * ROOT - Thats the root of server filesystem.
 * DS - Defining a foward slash with PHP DIRECTORY_SEPARATOR using str_replace.
 */
define('ROOT', str_replace('\\', '/', dirname(__FILE__)));
define('DS', str_replace('\\', '/', DIRECTORY_SEPARATOR));

/**
 * Public, Application, Vendor folder PATHS
 */
define('PUBLIC_PATH', ROOT . DS . 'public');
define('APPLICATION_PATH', ROOT . DS . 'application');
define('VENDOR_PATH', ROOT . DS . 'vendor');

/**
 * Views folder PATH
 */
define('VIEWS_PATH', PUBLIC_PATH . DS . 'views');

/**
 * Standard PHP way of autoloading classes - Using composer.
 */
require VENDOR_PATH . DS . 'autoload.php';

/*
|--------------------------------------------------------------------------
| Storing sensitive data in .env file
|--------------------------------------------------------------------------
|
| All live database credentials and any api keys are registered
| Highly recommended
|
*/
$dotenv = \Dotenv\Dotenv::createImmutable(ROOT, '.env');
$dotenv->load();
$dotenv->required(['LIVE_DATABASE_HOST', 'LIVE_DATABASE_NAME', 'LIVE_DATABASE_USERNAME', 'LIVE_DATABASE_PASSWORD', 'LIVE_DATABASE_CHARSET']);

/**
 * Current Enviroment.
 * Should be changed in production
 */
define('PROTOCOL', (((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on')) || ((isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')) ? 'https://' : 'http://');

/**
 * App Domain - like base url
 */
define('DOMAIN',  PROTOCOL.$_ENV['DOMAIN']);

/**
 * Display all errors during development
 */
if (Config::get('ENVIROMENT') === 'development') {
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
}

/**
 * Starting the session
 */
Session::start();

/**
 * -----------------------------------------------------------------------
 * Remember me cookie setup
 * -----------------------------------------------------------------------
 */
if((Authenticated::user()->status === false || Authenticated::user()->id === 0) && Cookie::exists(Config::get('REMEMBER_ME_COOKIE_NAME'))) {
    Login::remember();
}  

/**
 * --------------------------------------------------------------------
 * Handing the incoming request And Settings
 * --------------------------------------------------------------------
 */
$app = SlimAppFactory::create(new DI\Container());

/**
 * ---------------------------------------------------------------------
 * Adding all middlewares
 * ---------------------------------------------------------------------
 */
$middleware = require APPLICATION_PATH . DS . 'middleware.php';
$middleware($app);

/**
 * ---------------------------------------------------------------------
 * Route the application
 * ---------------------------------------------------------------------
 */
$routes = require APPLICATION_PATH . DS . 'routes.php';
$routes($app);

/**
 * ---------------------------------------------------------------------
 * Run the application
 * ---------------------------------------------------------------------
 */
$app->run();

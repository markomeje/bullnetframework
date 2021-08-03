<?php declare(strict_types=1);
 
namespace Bullnet\Errors\Renderer;

use Bullnet\Core\View;
use Slim\Exception\HttpNotFoundException;
use Slim\Interfaces\ErrorRendererInterface;
use Throwable;

 
final class ErrorRenderer implements  ErrorRendererInterface {
    
    /**
     * @var string
     */
    private static $title;

    /**
     * @var string
     */
    private static $message;

    /**
     * @var int
     */
    private static $code;

    public function __construct($title = 'Error Occured', $message = 'An Error Occured', $code = 503) 
    {
        self::$title = $title;
        self::$message = $message;
        self::$code = $code;
    }

    public function __invoke(Throwable $exception, bool $displayErrorDetails): string 
    {
        if ($exception instanceof HttpNotFoundException) {
            self::$title = 'Page Not Found';
            self::$message = self::$title;
            self::$code = 404;
        }
 
        View::render('errors.404', ['title' => htmlentities(self::$title, ENT_COMPAT|ENT_HTML5, 'utf-8'), 'message' => htmlentities(self::$message, ENT_COMPAT|ENT_HTML5, 'utf-8'), 'code' => self::$code]);
        return '';
    }
 
}
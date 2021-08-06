<?php

declare(strict_types=1);
namespace Bullnet\Core;
use \Exception;

class View 
{

    /**
     *@return void
     */
    public function __construct()
    {}

    /**
     * For rendering views files
     * @param string $view
     * @param array $data
     * @static static method
     */
	public static function render(string $view, aray $data = [], $response)
    {
        empty($data) ? [] : extract($data);
        if (strpos($view, '.') === false) {
            throw new Exception("View Path Must Contain A Period To Separate the Folder Name And File Name Without Spaces");
        }

        $view = explode('.', $view);
        $foldername = isset($view[0]) ? $view[0] : 'home';
        $filename = isset($view[1]) ? $view[1] : 'index';
        $view = $foldername.'/'.$filename;
        require_once VIEWS_PATH . DS . "includes" . DS . "header.php";
        require_once VIEWS_PATH . DS . $view . ".php";
        require_once VIEWS_PATH . DS . "includes" . DS . "footer.php";
        return $response;
    }

}
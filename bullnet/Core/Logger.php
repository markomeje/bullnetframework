<?php

namespace Bullnet\Core;
use Bullnet\Core\Help;


class Logger
{

    /**
     * Logs errors
     * @return void
     */
    public static function log(string $subject = "", $message = "", $fileName = "", $lineNumber = "") : void
    {
        $error = "*******************************************************************\n";
        $logfile = ROOT . DS . "errors.log";
        $error .= mb_strtoupper($subject)." Logged On ".Help::formatDatetime()."\n";
        $error .= is_array($message) ? implode("\n", $message) : $message."\n";
        $error .= "At File ".$fileName ." On Line ".$lineNumber ."\n";
        $error .= "*******************************************************************\n\n";

        if (file_exists($logfile)) {
            error_log($error, 3, $logfile);
        }
        
    }

}
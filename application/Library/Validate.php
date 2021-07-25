<?php

namespace Bullnet\Library;

class Validate 
{

    public static function range($input, $minimum, $maximum)
    {
    	$range = mb_strlen($input, 'utf8');
        return ($range >= (int)$minimum && $range <= (int)$maximum) ? true : false;
    }

    public static function password($password) 
    {
    	return ((trim($password) !== $password) || ctype_digit($password) || ctype_alpha($password) || mb_strlen($password) < 6) ? false : true;
    }

    public function array(array $array) : void
    {
        if (!is_array($array) || count($array) === 0) throw new Exception('');
    }

}
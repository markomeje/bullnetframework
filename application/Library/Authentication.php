<?php

namespace Bullnet\Library;
use Bullnet\Http\{Cookie};
use Bullnet\Library\Session;

class Authentication {

    public function __construct() {}

    public static function authenticate($credentials) {
        Cookie::set(session_name(), session_id(), time() + SESSION_COOKIE_EXPIRY);
        if (count($credentials) && is_array($credentials)) {
            foreach ($credentials as $key => $value) {
                Session::set($key, $value);
            }
        }   
    }

    public static function unauthenticate() {
        Session::destroy();
        Cookie::destroy(session_name(), time() - SESSION_COOKIE_EXPIRY);
    }

}
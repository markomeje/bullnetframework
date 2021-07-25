<?php

namespace Bullnet\Core;


class Encryption {
    
    /**
     * @var string
     */
    private static $algorithm = 'AES-128-CTR';

    /**
     * @var string
     */
    private static $iv = '1234567891011121';

    /**
     * @var string
     */
    private static $key = ENCRYPTION_KEY;

    /**
     * @var int
     */
    private static $options = 0;
 

    public static function encrypt($data) {
        $encrypted = openssl_encrypt($data, self::$algorithm, self::$key, self::$options, self::$iv);
        return $encrypted;
    }

    public static function decrypt($data) {
        $decrypted = openssl_decrypt($data, self::$algorithm, self::$key, self::$options, self::$iv);
        return $decrypted;
    }

}
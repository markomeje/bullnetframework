<?php

 /**
  * This file contains configurations for the application.
  */

return [

    'ENVIROMENT' => $_ENV['ENVIROMENT'],

    /**
     * Database Credentials for development
     * 
     */
    'LOCAL_DATABASE_HOST' => 'localhost',
    'LOCAL_DATABASE_NAME' => 'bullnet',
    'LOCAL_DATABASE_USERNAME' => 'root',
    'LOCAL_DATABASE_PASSWORD' => '',
    'LOCAL_DATABASE_CHARSET' => 'utf8',
    'LOCAL_DATABASE_PORT' => 3306,

    /**
     * Production Database Credentials
     * 
     */
    'LIVE_DATABASE_HOST' => $_ENV['LIVE_DATABASE_HOST'],
    'LIVE_DATABASE_NAME' => $_ENV['LIVE_DATABASE_NAME'],
    'LIVE_DATABASE_USERNAME' => $_ENV['LIVE_DATABASE_USERNAME'],
    'LIVE_DATABASE_PASSWORD' => $_ENV['LIVE_DATABASE_PASSWORD'],
    'LIVE_DATABASE_CHARSET' => $_ENV['LIVE_DATABASE_CHARSET'],

    /**
     * Configuration for: Paths
     * Paths from images directory
     */
    'IMAGES_PATH'  => PUBLIC_PATH . DS . 'images',

    /**
     * Configuration for: Cookies
     *
     * COOKIE_RUNTIME: How long should a cookie be valid by seconds.
     *      - 1209600 means 2 weeks
     *      - 604800 means 1 week
     * COOKIE_DOMAIN: The domain where the cookie is valid for.
     *      COOKIE_DOMAIN mightn't work with 'localhost', '.localhost', '127.0.0.1', or '.127.0.0.1'. If so, leave it as empty string, false or null.
     *      @see http://stackoverflow.com/questions/1134290/cookies-on-localhost-with-explicit-domain
     *      @see http://php.net/manual/en/function.setcookie.php#73107
     *
     * COOKIE_PATH: The path where the cookie is valid for. If set to '/', the cookie will be available within the entire COOKIE_DOMAIN.
     * COOKIE_SECURE: If the cookie will be transferred through secured connection(SSL). It's highly recommended to set it to true if you have secured connection
     * COOKIE_HTTP: If set to true, Cookies that can't be accessed by JS - Highly recommended!
     * COOKIE_SECRET_KEY: A random value to make the cookie more secure.
     *
     */
    'COOKIE_EXPIRY' => 1209600,
    'SESSION_COOKIE_EXPIRY' => 604800,
    'COOKIE_DOMAIN' => '',
    'COOKIE_PATH' => '/',
    'COOKIE_SECURE' => false,
    'COOKIE_HTTP' => true,
    'COOKIE_SECRET_KEY' => 'af&70-GF^!a{f64r5@g38l]#kQ4B+43%',
    
    /**
     * Remember me cookie details
     */
    'REMEMBER_ME_COOKIE_NAME' => '',
    'REMEMBER_ME_COOKIE_EXPIRY' => '',

    /**
     * Configuration for: Encryption Keys
     *
     */
    'ENCRYPTION_KEY' => '3¥‹a0cd@!$251Êìcef08%&',
    'HMAC_SALT' => 'a8C7n7^Ed0%8Qfd9K4m6d$86Dab',
    'HASH_KEY' => 'z4D8Mp7Jm5cHjgk',

    /**
     * Configuration for: Email server credentials
     * Emails are sent using SMTP, Don't use built-in mail() function in PHP.
     *
     */
    'EMAIL_SMTP_DEBUG' => 2,
    'EMAIL_SMTP_AUTH' => true,
    'EMAIL_SMTP_SECURE' => 'ssl',
    'EMAIL_SMTP_HOST' => 'YOURSMTPHOST',
    'EMAIL_SMTP_PORT' => 465,
    'EMAIL_SMTP_USERNAME' => 'YOURUSERNAME',
    'EMAIL_SMTP_PASSWORD' => 'YOURPASSWORD',
    'EMAIL_FROM' => 'info@YOURDOMAIN.com',
    'EMAIL_FROM_NAME' => 'mini PHP',
    'EMAIL_REPLY_TO' => 'no-reply@YOURDOMAIN.com',
    'ADMIN_EMAIL' => 'YOUREMAIL',

    /**
     * Configuration for: Email Verification
     *
     * EMAIL_EMAIL_VERIFICATION_URL: Full URL must be provided
     *
     */
    'EMAIL_EMAIL_VERIFICATION' => '1',
    'EMAIL_EMAIL_VERIFICATION_URL' => DOMAIN . 'Login/verifyUser',
    'EMAIL_EMAIL_VERIFICATION_SUBJECT' => '[IMP] Please verify your account',

    /**
     * Configuration for: Revoke email change
     *
     * EMAIL_REVOKE_EMAIL_URL: Full URL must be provided
     *
     */
    'EMAIL_REVOKE_EMAIL' => '2',
    'EMAIL_REVOKE_EMAIL_URL' => DOMAIN . 'User/revokeEmail',
    'EMAIL_REVOKE_EMAIL_SUBJECT' => '[IMP] Your email has been changed',

    /**
     * Configuration for: Confirm pending(updated) email
     *
     * EMAIL_UPDATE_EMAIL_URL: Full URL must be provided
     *
     */
    'EMAIL_UPDATE_EMAIL' => '3',
    'EMAIL_UPDATE_EMAIL_URL' => DOMAIN . 'User/updateEmail',
    'EMAIL_UPDATE_EMAIL_SUBJECT' => '[IMP] Please confirm your new email',

    /**
     * Configuration for: Reset Password
     *
     * EMAIL_PASSWORD_RESET_URL: Full URL must be provided
     *
     */
    'EMAIL_PASSWORD_RESET' => '4',
    'EMAIL_PASSWORD_RESET_URL' => DOMAIN . 'Login/resetPassword',
    'EMAIL_PASSWORD_RESET_SUBJECT' => '[IMP] Reset your password',

    /**
     * Configuration for: Report Bug, Feature, or Enhancement
     */
    'EMAIL_REPORT_BUG' => '5',
    'EMAIL_REPORT_BUG_SUBJECT' => 'Request',

    /**
     * Configuration for: Hashing strength
     *
     * It defines the strength of the password hashing/salting. '10' is the default value by PHP.
     * @see http://php.net/manual/en/function.password-hash.php
     *
     */
    'HASH_COST_FACTOR' => '10',

    /**
     * Configuration for: Pagination
     *
     */
    'DEFAULT_PAGINATION_LIMIT' => 10

];




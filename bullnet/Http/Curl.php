<?php

namespace Bullnet\Http;
use Bullnet\Core\Logger;
use \ApiException;

/**
 * Provides a top level utility for making outgoing http requests,
 * get, post, put and delete
 */
class Curl 
{

    /**
     * Curl resource
     * @var resource
     */
    private $curl;

    /**
     * Curl response
     * @var string
     */
    private $response;

    /**
     * Error message returned by curl
     * @var string
     */
    private $error;

    /**
     * Error number returned by curl
     * @var int
     */
    private $errornumber;

    /**
     * HTTP status code from external resource
     * @var inT 
     */
    private $code;

    /**
     * HTTP method
     * @var string 
     */
    private $method;

    /**
     * Initialize curl and set options appropriately
     * @param $url
     * @param $method
     */
    public function __construct(string $url = '', string $method = 'post', int $connecttimeout = 600, int $timeout = 1200, bool $runtimetransfer = true, bool $verifypeer = false) : void
    {
        $this->method = $method;
        $this->url = $url;
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, $runtimetransfer);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $connecttimeout);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, $verifypeer);
    }
    

    /**
     * Make api call
     * @param array $data
     * @param array $headers
     * @return array or null
     */
    public function call(array $data = [], array $headers = []) : ?array
    {
        $method = $this->method;
        new Curl($this->url, $method);
        try {
            if (strtolower($method) === 'post') {
                if (!is_array($data) || empty($data)) {
                    throw new ApiException('Post data can not be empty and must be an array.');
                }

                curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));
                if (count($headers)) {
                    curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
                }
            }

            $this->response = curl_exec($this->curl);
            $this->error = curl_error($this->curl);
            $this->errornumber = curl_errno($this->curl);
            $this->code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

            if (0 !== $this->errornumber) {
                throw new ApiException($this->error, $this->errornumber);
            }

            curl_close($this->curl);
            return $this->response;
        } catch (ApiException $exception) {
            Logger::log("CURL API RUNTIME ERROR", $error->getMessage(), __FILE__, __LINE__);
            return null;
        }
            
    }

}
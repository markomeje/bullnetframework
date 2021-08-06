<?php 


declare(strict_types=1);
namespace Bullnet\Http;


final class Response 
{
    
    /**
     * @var int
     */
	public $code;

	/**
     * @var array
     */
	public $headers;

	/**
     * @var object
     */
	public $response;

	/**
     * @return void
     */
	public function __construct($code = 200, $headers = [], $response) 
	{
		$this->headers = $headers;
		$this->code = $code;
		$this->response = $response;
	}

	public function send($data = null) 
	{
		empty($this->code) ? http_response_code() : http_response_code($this->code);
		if(isset($data) && is_array($data) && count($data) > 0) { 
			echo json_encode($data);
		}

		if (!headers_sent()) {
			if (is_array($this->headers) && count($this->headers) > 0) {
				foreach ($this->headers as $headers) {
					header("{$headers}", true);
				}
			}
		}
		return $this->response;
		
	}
}
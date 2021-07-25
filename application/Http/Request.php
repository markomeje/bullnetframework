<?php 

declare(strict_types=1);
namespace Bullnet\Http;


class Request 
{
    
    /**
     * @var int
     */
	public $request;

	/**
     * @var array
     */
	public $headers;

	/**
     * @var object
     */
	public $response;


	public function __construct($request) 
	{
		$this->request = $request;
		$this->body = $request->getBody();
		$this->post = (array)$request->getParsedBody();
		$this->get = $this->request->getParams();
	}

	/**
	 * Object instance
	 * @return self
	 */
	public function data() : self
	{
		$results = [$this->body, $this->post, $this->get];
		foreach ($results as $data => $values) {
			if (is_array($data)) {
				foreach ($data as $key => $value) {
					filter_input('', $value);
				}
			}elseif (is_object($data)) {
				if (isset($data->$key)) {
					trim($data->{$key});
				}
			}
		}
		return $this;
	}

	/**
	 * Post data
	 * @param $key
	 */
	public function post(string $key) : ?string
	{
		return (is_array($this->post) && isset($this->post[$key])) ? $this->post[$key] : null;
	}

	/**
	 * Get query params
	 * @param $key
	 */
	public function get(string $key) : ?string
	{
		return isset($this->get[$key]) ? $this->get[$key] : null;
	}

}
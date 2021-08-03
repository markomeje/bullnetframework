<?php

namespace Bullnet\Gateways;
use Bullnet\Core\Logger;
use Yabacon\Paystack;
use Yabacon\Paystack\Exception\ApiException;


class PaystackGateway {
    
    /**
     * @var object
     */
	public $paystack;

	public function __construct() {
		$this->paystack = new Paystack(PAYSTACK_LIVE_SECRET_KEY);
	}

	public function initialize($data = []) {
        try{
            return $this->paystack->transaction->initialize($data);
        } catch(ApiException $error){
        	Logger::log('PAYSTACK API INITIALIZATION ERROR', $error->getMessage(), $error->getFile(), $error->getLine());
            return false;
	    }
    }

    public function verify($reference = '') {
        try{
            return $this->paystack->transaction->verify(['reference' => $reference]);
        } catch(ApiException $error){
        	Logger::log('PAYSTACK API VERIFICASTION ERROR', $error->getMessage(), $error->getFile(), $error->getLine());
            return false;
	    }
    }

}
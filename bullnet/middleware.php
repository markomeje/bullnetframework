<?php

use Slim\App;
use Bullnet\Errors\Renderer\ErrorRenderer;


return function(App $app) 
{
	/**
	 * Slim Routing Middleware
	 */
	$app->addRoutingMiddleware();
    
    /**
	 * Slim Error Middleware
	 * Render a nice view in production
	 */
	$error = $app->addErrorMiddleware(true, true, true);
	if (config()->get('ENVIROMENT') === 'production') {
		$handler = $error->getDefaultErrorHandler();
        $handler->registerErrorRenderer('text/html', ErrorRenderer::class);
	}
};
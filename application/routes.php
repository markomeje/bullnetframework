<?php

use Slim\App;
use Bullnet\Middlewares\{GuestMiddleware, AuthenticatedMiddleware};
use Bullnet\Middlewares\Roles\{AdminMiddleware};
use Slim\Routing\RouteCollectorProxy;

return function(App $app) 
{
	$app->get('/', [\Bullnet\Controllers\HomeController::class, 'index']);

	// $app->get('/dashboard', \Bullnet\Controllers\DashboardController::class . ':index')->add(AuthenticatedMiddleware::class);

	// $app->group('/login', function(RouteCollectorProxy $group) {
	// 	$group->get('', \Bullnet\Controllers\LoginController::class . ':index')->add(GuestMiddleware::class);
	// 	$group->post('', \Bullnet\Controllers\LoginController::class . ':signin');
	// 	$group->post('/logout', \Bullnet\Controllers\LoginController::class . ':logout');
	// });
    
 //    $app->group('/signup', function(RouteCollectorProxy $group) {
	// 	$group->get('', \Bullnet\Controllers\SignupController::class . ':index')->add(GuestMiddleware::class);
	// 	$group->get('/thanks', \Bullnet\Controllers\SignupController::class . ':thanks');
	// 	$group->post('', \Bullnet\Controllers\SignupController::class . ':signup');
	// });

 //    $app->group('/password', function(RouteCollectorProxy $group) {
 //    	$group->post('/process', \Bullnet\Controllers\PasswordController::class . ':process');
	//     $group->get('/reset', \Bullnet\Controllers\PasswordController::class . ':index');
	//     $group->post('/reset', \Bullnet\Controllers\PasswordController::class . ':reset');
 //    });

 //    $app->group('/assets', function(RouteCollectorProxy $group) {
	//     $group->get('/css', function() {});
	//     $group->get('/js', function() {});
	//     $group->get('/images', function() {});
 //    });

    $app->any('{route:.*}', [\Bullnet\Controllers\ErrorsController::class, 'index']);

};
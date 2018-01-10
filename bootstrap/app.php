<?php

session_start();

require '../vendor/autoload.php';

$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
		'determineRouteBeforeAppMiddleware' => true,
	    'addContentLengthHeader' => false,
		'db' => [
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'joyce',
			'username' => 'root',
			'password' => '',
			'collation' => 'latin1_swedish_ci',
			'prefix' => ''
		]
	]
]);

$container = $app->getContainer();

$container['CardController'] = function($container) {
	return new \Carbon\Controllers\CardController($container);
};


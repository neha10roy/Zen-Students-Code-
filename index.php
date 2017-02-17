<?php
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require 'lib/vendor/autoload.php';
	require 'src/config/db.php';

	$app = new \Slim\App;


	// Routes
	require 'src/routes/customermanagement.php';

	

	$app->run();

?>



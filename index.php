<?php 
	require 'vendor/autoload.php';

	$app = new \Slim\Slim(array(
    'debug' => true
	));

	$app->setName('multistat-api');

	//Routes
	$app->get('/', 'home');

	$app->group('/api', function () use ($app) {

		$app->group('/v1', function () use ($app) {

			$app->get('/:api', 'V1:stat');

		});

	});

	$app->contentType('application/json');

	# lets go
	$app->run();


	function home() {
		echo "You shall not pass";
	}


	class V1 {
		
		#stat
		public function stat($api) {
			echo "im currency";
		}

	}
	
?>
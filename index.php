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

			$app->group('/:api', function () use ($app) {

				#currency
				$app->get('/currency', 'V1:currency');

				#workers
				$app->get('/workers', 'V1:workers');

				#transactions
				$app->get('/transactions', 'V1:transactions');

			});

		});

	});

	$app->contentType('application/json');

	# lets go
	$app->run();


	function home() {
		echo "You shall not pass";
	}


	class V1 {
		
		#currency
		function currency($api) {
			echo "im currency";
		}

		#workers
		function workers($api) {
			echo "im workers";
		}

		#transactions
		function transactions($api) {
			echo "im transactions";
		}

	}
	
?>
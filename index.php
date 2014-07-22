<?php 
	require 'vendor/autoload.php';

	date_default_timezone_set('America/New_York');

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

	//$app->contentType('application/json');

	# lets go
	$app->run();


	function home() {
		echo "You shall not pass";
	}


	class V1 {
		
		#stat
		public function stat($api) {
			
			$url = 'http://api.multipool.us/api.php?api_key='.$api.'';
			$cmd = array();
			$data = array('json' => json_encode($cmd));
			
			$options = array(
			  'http' => array(
			      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			      'method'  => 'POST',
			      'content' => http_build_query($data),
			  ),
			);

			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$result = json_decode($result, true);

			var_dump($result);

			echo "im currency";
		}

	}
	
?>
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

		$es = new Elasticsearch\Client(
		  array(
		    'hosts' => array(
		      '192.241.165.56:9200'
		    )
		  )
		);

		$es->index(
		  array(
		    'index' => 'multitat',
		    'type' => 'user',
		    'id' => '411639a04849a8a9cd2c3da637f313de5e60203abb94ef8a0e69f6127adb91d6',
		    'body'  => array(
		      'aur' => array(
		      	'confirmed_rewards' => '0.0000000000000000',
		      	'hashrate' => '0',
		      	'round_shares' => 'false',
		      	'block_shares' => '0',
		      	'estimated_rewards' => '0',
		      	'payout_history' => '0',
		      	'pool_hashrate' => '6311'
		      ),
		      'btc' => '0.0000468070917350',
		      'cap'    => '0.0654612854123116'
		    )
		  )
		);

		$doc = $es->get(
		  array(
		  	'index' => 'multitat',
        'type'  => 'user',
		    'id' => '411639a04849a8a9cd2c3da637f313de5e60203abb94ef8a0e69f6127adb91d6'
		  )
		);

		echo "<pre>";
		var_dump($doc);
		echo "</pre>";

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
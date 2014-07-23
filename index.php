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

			$app->group('/:api', function () use ($app) {

				$app->get('/stat', 'V1:pull');
			});

		});

	});

	$app->contentType('application/json');

	# lets go
	$app->run();


	function home() {
		echo "You shall not pass";

		#connect
		$es = new Elasticsearch\Client(
		  array(
		    'hosts' => array(
		      '192.241.165.56:9200'
		    )
		  )
		);

		#index
		//$params = array();
    //$params['body']  = array(
    //		'testField' => 'abc',
    //		'currency' => array(
		//      array(
		//      	'aur' => array(
		//      		'confirmed_rewards' => '0.000'
		//      	),
		//      	'btc' => array(
		//      		'confirmed_rewards' => '0.000'
		//      	)
		//      ),
		//      array('popularity' => array('order' => 'desc'))
		//    )
    //	);
    //$params['index'] = 'multitat';
    //$params['type']  = 'user';
    //$params['id']    = '411639a04849a8a9cd2c3da637f313de5e60203abb94ef8a0e69f6127adb91d6';
    //$es->index($params);

    #get
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
			
			#connect
			$es = new Elasticsearch\Client(
			  array(
			    'hosts' => array(
			      '192.241.165.56:9200'
			    )
			  )
			);

			$stat = $es->get(
			  array(
			  	'index' => 'multitat',
	        'type'  => 'user',
			    'id' => $api
			  )
			);

			echo json_encode($stat);

		}

		#pull
		public function pull($api) {

			#connect
			$es = new Elasticsearch\Client(
			  array(
			    'hosts' => array(
			      '192.241.165.56:9200'
			    )
			  )
			);
			
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

			//var_dump($result);

			$currency = $result['currency'];
			$workers = $result['workers'];

			// check if we have something return
			if ($currency) {

				foreach ($currency as $currencys => $balance_d) {
			
					if ($balance_d['confirmed_rewards'] != 0) {
						$response['currency'][] = array(
					 		'currency' => $currencys,
							'confirmed_rewards' => $balance_d['confirmed_rewards'],
							'hashrate' => $balance_d['hashrate'],
							'round_shares' => $balance_d['round_shares'],
							'block_shares' => $balance_d['block_shares'],
							'estimated_rewards' => $balance_d['estimated_rewards'],
							'payout_history' => $balance_d['payout_history'],
							'pool_hashrate' => $balance_d['pool_hashrate']
						);
					}

				}

				//ok lets show the active workers
				foreach ($workers as $worker => $work_d) {

					foreach ($work_d as $work => $hash) {
						if ($hash['hashrate'] != 0) {
							$response['workers'][] = array(
								'coin' => $worker,
								'worker' => $work, 
								'hashrate' => $hash['hashrate']
							);
						}
					}
					
				}

				#index
				$params = array();
		    $params['body']  = $response;
		    $params['index'] = 'multitat';
		    $params['type']  = 'user';
		    $params['id']    = $api;
		    $es->index($params);

				
				#get
				$stat = $es->get(
				  array(
				  	'index' => 'multitat',
		        'type'  => 'user',
				    'id' => $api
				  )
				);

				echo json_encode($stat);

			} else { // panic

				$response['response'] = array(
					'status' => '500'
				);

			}

		}

	}
	
?>
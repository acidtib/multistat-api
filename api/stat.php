<?php
	
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json;');
	
	date_default_timezone_set('America/New_York');

	$url = 'https://www.multipool.us/api2.php?api_key='.$_GET['api_key'].'';
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

	$currency = $result['currency'];


	if (($currency['arg']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'arg',
				'confirmed_rewards' => $currency['arg']['confirmed_rewards']
		);

	}

	if (($currency['btc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'btc',
				'confirmed_rewards' => $currency['btc']['confirmed_rewards']
		);
		
	}

	if (($currency['cap']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'cap',
				'confirmed_rewards' => $currency['cap']['confirmed_rewards']
		);
		
	}

	if (($currency['cgb']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'cgb',
				'confirmed_rewards' => $currency['cgb']['confirmed_rewards']
		);
		
	}

	if (($currency['dgc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'dgc',
				'confirmed_rewards' => $currency['dgc']['confirmed_rewards']
		);
		
	}

	if (($currency['dmd']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'dmd',
				'confirmed_rewards' => $currency['dmd']['confirmed_rewards']
		);
		
	}

	if (($currency['doge']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'doge',
				'confirmed_rewards' => $currency['doge']['confirmed_rewards']
		);
		
	}

	if (($currency['frc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'frc',
				'confirmed_rewards' => $currency['frc']['confirmed_rewards']
		);
		
	}

	if (($currency['ftc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'ftc',
				'confirmed_rewards' => $currency['ftc']['confirmed_rewards']
		);
		
	}

	if (($currency['lky']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'lky',
				'confirmed_rewards' => $currency['lky']['confirmed_rewards']
		);
		
	}

	if (($currency['ltc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'ltc',
				'confirmed_rewards' => $currency['ltc']['confirmed_rewards']
		);
		
	}

	if (($currency['mec']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'mec',
				'confirmed_rewards' => $currency['mec']['confirmed_rewards']
		);
		
	}

	if (($currency['mnc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'mnc',
				'confirmed_rewards' => $currency['mnc']['confirmed_rewards']
		);
		
	}

	if (($currency['nvc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'nvc',
				'confirmed_rewards' => $currency['nvc']['confirmed_rewards']
		);
		
	}

	if (($currency['ppc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'ppc',
				'confirmed_rewards' => $currency['ppc']['confirmed_rewards']
		);
		
	}

	if (($currency['pxc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'pxc',
				'confirmed_rewards' => $currency['pxc']['confirmed_rewards']
		);
		
	}

	if (($currency['tag']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'tag',
				'confirmed_rewards' => $currency['tag']['confirmed_rewards']
		);
		
	}

	if (($currency['trc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'trc',
				'confirmed_rewards' => $currency['trc']['confirmed_rewards']
		);
		
	}

	if (($currency['wdc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'wdc',
				'confirmed_rewards' => $currency['wdc']['confirmed_rewards']
		);
		
	}

	if (($currency['zet']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'zet',
				'confirmed_rewards' => $currency['zet']['confirmed_rewards']
		);
		
	}

	if (($currency['tips']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'tips',
				'confirmed_rewards' => $currency['tips']['confirmed_rewards']
		);
		
	}

	if (($currency['gdc']['confirmed_rewards'] != 0)) {

		$response['currency'][] = array(
		 		'currency' => 'gdc',
				'confirmed_rewards' => $currency['gdc']['confirmed_rewards']
		);
		
	}



	//currently mining

	function is_it_sha($btc) {
		
		if ($currency['btc']['hashrate'] == '0') {
			$sha = 'n/a';
		} else {
			$sha = $btc;
		}

		return $sha;
	}

	$response['mining'] = array(
		'scrypt' => 'doge', 
		'sha-256' => is_it_sha($currency['btc']['hashrate']),
	);

	echo json_encode($response);


?>
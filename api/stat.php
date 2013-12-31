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

	function is_it_sha($btc, $frc, $ppc, $trc, $zet) {
		
		if ($btc != 0) {
			$sha = 'BTC';
		} elseif ($frc != 0) {
			$sha = 'FRC';
		} elseif ($ppc != 0) {
			$sha = 'PPC';
		} elseif ($trc != 0) {
			$sha = 'TRC';
		} elseif ($zet != 0) {
			$sha = 'ZET';
		} else {
			$sha = 'n/a';
		}

		return $sha;
	}

	function is_it_scrypt($ltc, $ftc, $mnc, $wdc, $dgc, $nvc, $lky, $arg, $pxc, $mec, $cap, $cgb, $doge, $dmd, $tips, $gdc, $moon) {
		
		if ($ltc != 0) {
			$scrypt = 'LTC';
		} elseif ($ftc != 0) {
			$scrypt = 'FTC';
		} elseif ($mnc != 0) {
			$scrypt = 'MNC';
		} elseif ($wdc != 0) {
			$scrypt = 'WDC';
		} elseif ($dgc != 0) {
			$scrypt = 'DGC';
		} elseif ($nvc != 0) {
			$scrypt = 'NVC';
		} elseif ($lky != 0) {
			$scrypt = 'LKY';
		} elseif ($arg != 0) {
			$scrypt = 'ARG';
		} elseif ($pxc != 0) {
			$scrypt = 'PXC';
		} elseif ($mec != 0) {
			$scrypt = 'MEC';
		} elseif ($cap != 0) {
			$scrypt = 'CAP';
		} elseif ($cgb != 0) {
			$scrypt = 'CGB';
		} elseif ($doge != 0) {
			$scrypt = 'DOGE';
		} elseif ($dmd != 0) {
			$scrypt = 'DMD';
		} elseif ($tips != 0) {
			$scrypt = 'TIPS';
		} elseif ($gdc != 0) {
			$scrypt = 'GDC';
		} elseif ($moon != 0) {
			$scrypt = 'MOON';
		} else {
			$scrypt = 'n/a';
		}

		return $scrypt;

	}

	$response['mining'] = array(
		'scrypt' => is_it_scrypt($currency['ltc']['hashrate'], $currency['ftc']['hashrate'], $currency['mnc']['hashrate'], $currency['wdc']['hashrate'], $currency['dgc']['hashrate'], $currency['nvc']['hashrate'], $currency['lky']['hashrate'], $currency['arg']['hashrate'], $currency['pxc']['hashrate'], $currency['mec']['hashrate'], $currency['cap']['hashrate'], $currency['cgb']['hashrate'], $currency['doge']['hashrate'], $currency['dmd']['hashrate'], $currency['tips']['hashrate'], $currency['gdc']['hashrate'], $currency['moon']['hashrate']), 
		'sha-256' => is_it_sha($currency['btc']['hashrate'], $currency['frc']['hashrate'], $currency['ppc']['hashrate'], $currency['trc']['hashrate'], $currency['zet']['hashrate']),
	);

	echo json_encode($response);


?>
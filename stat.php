<?php
	
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json;');
	
	date_default_timezone_set('America/New_York');

	//$url = 'https://www.multipool.us/api2.php?api_key='.$_GET['api_key'].'';
	$url = 'http://api.multipool.us/api2.php?api_key='.$_GET['api_key'].'';
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

	$balances = $result['currency'];

	$workers = $result['workers'];


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



	// check if we have something return
	
	if ($currency) {

		$response['status'] = array(
			'what' => '200'
		);
		
		// do we have a balance
		foreach ($balances as $currencys => $balance_d) {
			
			if ($balance_d['confirmed_rewards'] != 0) {
				$response['currency'][] = array(
			 		'currency' => $currencys,
					'confirmed_rewards' => $balance_d['confirmed_rewards']
				);
			}

		}

		// what are we mining
		$response['mining'] = array(
			'scrypt' => is_it_scrypt($currency['ltc']['hashrate'], $currency['ftc']['hashrate'], $currency['mnc']['hashrate'], $currency['wdc']['hashrate'], $currency['dgc']['hashrate'], $currency['nvc']['hashrate'], $currency['lky']['hashrate'], $currency['arg']['hashrate'], $currency['pxc']['hashrate'], $currency['mec']['hashrate'], $currency['cap']['hashrate'], $currency['cgb']['hashrate'], $currency['doge']['hashrate'], $currency['dmd']['hashrate'], $currency['tips']['hashrate'], $currency['gdc']['hashrate'], $currency['moon']['hashrate']), 
			'sha_256' => is_it_sha($currency['btc']['hashrate'], $currency['frc']['hashrate'], $currency['ppc']['hashrate'], $currency['trc']['hashrate'], $currency['zet']['hashrate']),
		);


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

	} else {
		
		$response['status'] = array(
			'what' => '500'
		);

	}


	echo json_encode($response);


?>
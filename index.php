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

      $app->group('/:api', function () use ($app) {

        $app->get('/stat', 'V1:stat');

        $app->get('/pull', 'V1:pull');

      });

    });

  });

  //$app->contentType('application/json');

  # lets go
  $app->run();


  function home() {
    echo "Hello";
  }


  class V1 {

    #stat
    public function stat($api) {

      echo "Hello";

    }

    #pull
    public function pull($api) {

      include ('lib/functions.php');

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

              $active[] = array(
                'coin' => $worker,
                'type' => what_is_it($worker)
              );
            }
          }

        }

        if ($active) {
          $active = array_map("unserialize", array_unique(array_map("serialize", $active)));
        } else {
          $active = false;
        }

        if (false !== ($scrypt = array_search2d('scrypt', $active))) {
            $scrypt = $active[$scrypt]['coin'];
        } else {
            $scrypt = 'n/a';
        }

        if (false !== ($scrypt_n = array_search2d('scrypt-n', $active))) {
            $scrypt_n = $active[$scrypt_n]['coin'];
        } else {
            $scrypt_n = 'n/a';
        }

        if (false !== ($sha_256 = array_search2d('sha-256', $active))) {
            $sha_256 = $active[$sha_256]['coin'];
        } else {
            $sha_256 = 'n/a';
        }

        if (false !== ($x11 = array_search2d('x11', $active))) {
            $x11 = $active[$x11]['coin'];
        } else {
            $x11 = 'n/a';
        }

        $response['mining'] = array(
          'scrypt' => $scrypt,
          'scrypt_n' => $scrypt_n,
          'sha_256' => $sha_256,
          'x11' => $x11
        );

        $url = 'https://multistat.firebaseio.com/users/'.$api.'.json';

        $content = json_encode($response);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $response = json_decode($json_response, true);


        $call_response['response'] = array(
          'status' => '200'
        );


      } else { // panic

        $call_response['response'] = array(
          'status' => '500'
        );

      }

      echo json_encode($call_response);

    }

  }

?>

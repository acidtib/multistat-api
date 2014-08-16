<?php

  function what_is_it($coin)
  {

    $scrypt = array(
      'anc',
      'aur',
      'cap',
      'cgb',
      'dgb',
      'dgc',
      'doge',
      'eac',
      'ftc',
      'ltc',
      'mec',
      'mnc',
      'mona',
      'moon',
      'naut',
      'ntr',
      'nvc',
      'pot',
      'pxc',
      'rdd',
      'rzr',
      'tips',
      'via',
      'wdc'
    );

    $scrypt_n = array(
      'rt2',
      'spt',
      'vtc'
    );

    $x11 = array(
      'crypt',
      'drk',
      'frac',
      'karm',
      'ltcx',
      'uro'
    );

    $sha_256 = array(
      'btc',
      'frc',
      'myrh',
      'mzc',
      'ppc',
      'trc',
      'unb',
      'uno',
      'zet',
      'dvc',
      'ixc',
      'nmc'
    );

    if (in_array($coin, $scrypt)) {
    	return 'scrypt';
    } elseif (in_array($coin, $scrypt_n)) {
      return 'scrypt-n';
    } elseif (in_array($coin, $x11)) {
      return 'x11';
    } elseif (in_array($coin, $sha_256)) {
      return 'sha-256';
    } else {
      return 'n/a';
    }

  }


  function super_unique($array)
  {
    $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

    foreach ($result as $key => $value)
    {
      if ( is_array($value) )
      {
        $result[$key] = super_unique($value);
      }
    }

    return $result;
  }

  function array_search2d($needle, $haystack) {
  	for ($i = 0, $l = count($haystack); $i < $l; ++$i) {
      if (in_array($needle, $haystack[$i])) return $i;
    }
      return false;
  }

?>

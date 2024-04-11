<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function Cidr($network) { 

    $parts = explode('/',$network);
    $exponent = 32-$parts[1].'-';
    $count = pow(2,$exponent);
    $start = ip2long($parts[0]);
    $end = $start+$count;
    $data = array_map('long2ip', range($start, $end) );

	return $data;
}
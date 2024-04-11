<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function checkPort($host, $port) { 
   
   $connection = @fsockopen($host, $port, $errno, $errstr, 2);

    if (is_resource($connection)){
		
        fclose($connection);
		return true;
	}	
    else
	{	
        return false;
	}
}	

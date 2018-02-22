<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
 /**
 * debug() is a debugging functions that var_dump($anything);
 * @param  [mixed] $data is the data you want to debug
 * @param  [boolean] $die , true by default
 * @return void
 */
function debug($data, $die=false) {
    echo'<pre>';
    	var_dump($data);
    echo '</pre>';
    
    if ($die)
    {
        die();
    }

}

 ?>
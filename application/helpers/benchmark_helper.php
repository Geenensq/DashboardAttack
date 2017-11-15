<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   
function benchmarkStart() {
    return $this->benchmark->mark('request_start');
}


function benchmarkStop() {
   return $this->benchmark->mark('request_end');
}



 ?>
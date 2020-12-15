<?php

$start = microtime(true);


$array = explode(",", "14,3,1,0,9,5");

$pos = [];
foreach($array as $k=>$v) {
  $array[$k] = (int)$v;
  $pos[(int)$v] = $k;
}

$iterator = count($array)-1;
$next = $array[$iterator];

while ($iterator < 30000000 - 1) {
  
  	$current = $next;
    $next = 0;
  
  	if(array_key_exists($current, $pos)){
      $next = $iterator - $pos[$current];
    }
  
    $pos[$current] = $iterator;
	$iterator++;
  
}

echo $next;

$time_elapsed_secs = microtime(true) - $start;
echo $time_elapsed_secs . "sec \n";
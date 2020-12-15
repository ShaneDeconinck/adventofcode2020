<?php

$start = microtime(true);

$input = "14,3,1,0,9,5";
$array = explode(",", $input);
$iterator = count($array)-1;

$pos = [];
foreach($array as $k=>$v) {
  $array[$k] = (int)$v;
  $pos[(int)$v] = (int)$k;
}

$next = $array[count($array)-1];

while ($iterator < (30000000 - 1)) {
  	$current = $next;
  	if(array_key_exists((int)$current, $pos)){
      $next = $iterator - $pos[$current];
    } else {
    	$next = 0;
    }
    $pos[$current] = $iterator;
	$iterator++;
}

$time_elapsed_secs = microtime(true) - $start;
echo $time_elapsed_secs . "sec \n";
echo $next;
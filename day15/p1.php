<?php

$input = "14,3,1,0,9,5";
$array = explode(",", $input);
$iterator = count($array)-1;

while ($iterator < 2020 - 1) {
  	$current = $array[$iterator];
  
  	$filteredArray = collect($array)->except($iterator)->filter(function($item) use ($current) {
      return $item == $current;
    });
  	
  	if($filteredArray->count() === 0) {
    	$array[] = 0;
    } else {
    	$array[] = $iterator - $filteredArray->keys()->last();
    }
	$iterator++;
}

echo count($array) ."\n";
echo collect($array)->last();


// version 2 with dictionary

$input = "14,3,1,0,9,5";
$array = explode(",", $input);
$iterator = count($array)-1;
$pos = [];

foreach($array as $k=>$v) {
  $array[$k] = (int)$v;
  $pos[(int)$v] = (int)$k;
}

while ($iterator < 2020 - 1) {
  	$current = $array[$iterator];
  
  	if(array_key_exists((int)$current, $pos)){
      $array[] = $iterator - $pos[$current];
    } else {
    	$array[] = 0;
    }
  
  	$pos[$current] = $iterator;
	$iterator++;
}

echo count($array) ."\n";
echo collect($array)->last();
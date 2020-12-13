<?php

// this worked fine for small inputs
$busses="1789,37,47,1889";

$busses = collect(explode(',',$busses))->filter(function($i) {return $i !== 'x';})->sort();


$max = $busses->max();
$maxKey = $busses->search($max);

$busses = $busses->toArray();
$result = false;
$iterator = 1;

do {
  
  foreach ($busses as $key => $item) { 
    $result = (($iterator * $max) - ($maxKey - $key)) % $item === 0;
    
    
    if ($result !== true) {break;} 
  
  }
  if ($result === false){ $iterator++;}
} while($result !== true);

echo $iterator * $max - $maxKey . " \n \n";


// This is the actual solution using Chinese Remainder Theorem
// Inspired by https://github.com/jainaman224/Algo_Ds_Notes/blob/master/Chinese_Remainder_Theorem/Chinese_Remainder_Theorem.php

// function to find modular multiplicative inverse of 
// 'val' under modulo 'm' 
function modInv($val, $m) { 
  $val = $val % $m; 

  for ($x = 1; $x < $m; $x++) {
      if (($val * $x) % $m == 1) {
          return $x; 
      }
  }
} 

/* 
findVal() returns the smallest number reqValue such that: 
reqValue % div[0] = rem[0], 
reqValue % div[1] = rem[1], 
..... 
reqValue % div[k-2] = rem[k-1] 
It is assumed that the numbers in div[] are pairwise coprime.
*/
function crt($dividers, $remainders, $size) { 
// $totalProd represents product of all numbers 
$totalProd = $dividers->reduce(function($carry, $item){return $carry*$item;}, 1);
  
  $zip = $dividers->zip($remainders);
  // $result represents summation of 
  // (rem[i] * partialProd[i] * modInv[i]) 
  // for 0 <= i <= size-1
$result = $zip->reduce(function($carry, $item) use ($totalProd) {
  $partialProd = (int) $totalProd / $item[0]; 

    return $carry + $item[1]* $partialProd * modInv($partialProd, $item[0]); }, 0); 
  
  $reqValue = $result % $totalProd;
  return $reqValue; 
} 

$input = "23,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,37,x,x,x,x,x,431,x,x,x,x,x,x,x,x,x,x,x,x,13,17,x,x,x,x,19,x,x,x,x,x,x,x,x,x,x,x,409,x,x,x,x,x,x,x,x,x,41,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,29";

$busses = collect(explode(',',$input))->filter(function($i) {return $i !== 'x';});

$dividers = $busses->values()->map(function($item) { return (int) $item;});

$remainders = $busses->values()->map(function ($item) use ($busses) {$result = $item - $busses->search($item); return $result;});

$result = crt($dividers, $remainders, count($dividers));

echo($result);
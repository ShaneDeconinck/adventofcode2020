<?php

$earliest = 1003681;
$busses ="23,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,37,x,x,x,x,x,431,x,x,x,x,x,x,x,x,x,x,x,x,13,17,x,x,x,x,19,x,x,x,x,x,x,x,x,x,x,x,409,x,x,x,x,x,x,x,x,x,41,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,x,29";

$busses = collect(explode(',',$busses))->filter(function($i) {return $i !== 'x';});

$waitingTimes = $busses->mapWithKeys(function($i) use ($earliest) {return [$i => (int)((floor($earliest / $i) + 1) * $i) - $earliest];})->sort();

$bus = $waitingTimes->keys()->first();
$waitingTime = $waitingTimes->first();

echo $bus * $waitingTime;
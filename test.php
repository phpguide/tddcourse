<?php

function SumUpToNumber($x)
{
//    (1 + 100) + (2 + 99) + (3 + 98) + . . . . + (50 + 51) = ?
//    1 + 2 + 3 + 4 + . . . . + N = (1 + N)*(N/2)
    $multiplier = $x > 0 ? 1 : -1;
    return ($multiplier + $x) * (abs($x) / 2);
}


if(3 == SumUpToNumber(2))
    echo 'ok';
if(15 == SumUpToNumber(5))
    echo 'ok';
if(6 == SumUpToNumber(3))
    echo 'ok';

if(1 == SumUpToNumber(1))
    echo 'ok';

if(0 == SumUpToNumber(0))
    echo 'ok';

if(-3 == SumUpToNumber(-2))
    echo 'ok';
else
    echo 'false';


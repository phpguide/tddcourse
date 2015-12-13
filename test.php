<?php

function SumUpToNumber($x)
{
    $multiplier = $x > 0 ? 1 : -1;
    return $multiplier * (1 + abs($x)) * (abs($x) / 2);
}


function AssertEquals($a, $b)
{
    echo $a == $b ? 'ok':'notok';
}

function AssertArrayContains($a, $arr)
{
    return in_array($a, $arr, true);
}

AssertEquals(3, SumUpToNumber(2));
AssertEquals(15, SumUpToNumber(5));
AssertEquals(6, SumUpToNumber(3));
AssertEquals(1, SumUpToNumber(1));
AssertEquals(0, SumUpToNumber(0));
AssertEquals(-3, SumUpToNumber(-2));

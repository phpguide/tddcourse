<?php
namespace MegaCalc;


class Calculator
{
    public function Add(...$params){
        if(count($params) > 5)
            throw new \InvalidArgumentException("TooManyArguments");

        return array_sum($params);
    }
}
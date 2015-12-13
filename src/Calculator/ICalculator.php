<?php

namespace Calculator;


interface ICalculator
{
    public function Add(...$a);
    public function Sub($a, $b);
    public function Div($a, $b);
}
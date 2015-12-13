<?php
namespace Calculator;

use Prophecy\Exception\InvalidArgumentException;

class BasicCalculator implements ICalculator
{

    /**
     * @param ...$a
     * @return number
     */
    public function Add(...$a)
    {
        return array_sum($a);
    }

    public function Sub($a, $b)
    {
        return $a - $b;
    }

    public function Div($a, $b)
    {
        if($b === 0)
            throw new InvalidArgumentException("Divider Cannot be zero");

        return $a / $b;
    }
}
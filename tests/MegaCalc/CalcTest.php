<?php
namespace MegaCalc;


class CalcTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Calculator */
    protected $calc;

    protected function setUp() {
        $this->calc = new Calculator();
    }

    public function testAddNumbers()
    {
        $this->assertEquals(1, $this->calc->Add(1));
        $this->assertEquals(5, $this->calc->Add(2, 3));
        $this->assertEquals(9, $this->calc->Add(2, 3, 4));
        $this->assertEquals(14, $this->calc->Add(2, 3, 4, 5));
        $this->assertEquals(20, $this->calc->Add(2, 3, 4, 5, 6));
    }


    /** @expectedException \InvalidArgumentException
     * @expectedExceptionMessage TooManyArguments */
    public function test_ExceptionWhenMoreThan5Numbers(){
        $this->calc->Add(1,2,1,1,1,1);
    }
}
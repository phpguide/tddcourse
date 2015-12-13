<?php

class BasicCalcutorTest extends PHPUnit_Framework_TestCase
{


    /** @var \Calculator\BasicCalculator */
    private $calc;

    public function setUp()
    {
        $this->calc = new \Calculator\BasicCalculator();
    }

    /**
     * @dataProvider additionalProvider
     */
    public function testAdd_2Numbers_CorrectResult($a, $b, $ex)
    {
        $this->assertEquals($ex, $this->calc->Add($a, $b));
    }

    public function testSub_2Numbers_correctResult()
    {
        $this->assertEquals(2, $this->calc->Sub(5, 3));
    }

    public function testDiv_2Numbers_ReturnsProperResult()
    {
        $this->assertEquals(3, $this->calc->Div(15, 5));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Divider Cannot be zero
     */
    public function testDev_DivByZero_ThrowsException()
    {
        $this->calc->Div(4, 0);
    }


    public function additionalProvider()
    {
        return array(
            array(2, 3, 5),
            array(0, 1, 1),
            array(1, 0, 1),
            array(1, 1, 2)
        );
    }
}
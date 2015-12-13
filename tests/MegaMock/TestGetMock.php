<?php
namespace MegaMock;

class TestGetMock extends \PHPUnit_Framework_TestCase{

    public function testGetObject_ReturnsInstanceOfClass(){
        $mock = new MegaMock(Type1::class);
        $this->assertInstanceOf(Type1::class, $mock->getObject());
    }



    public function testGetObject_ReturnsInstanceOfInterface(){
        $mock = new MegaMock(Int1::class);
        $this->assertInstanceOf(Int1::class, $mock->getObject());
    }

    public function test_MethodCall_ReturnsAReturnManager(){
        $mock = new MegaMock(Int1::class);
        $this->assertInstanceOf(ReturnManager::class,$mock->myCoolMethod());
    }

    public function test_SetupReturnValue_ActuallReturnsTheValue(){
        $mock = new MegaMock(Int1::class);
        $mock->Yo()->willReturn('Hi');
        $this->assertEquals('Hi', $mock->getObject()->Yo());
    }

    public function test_SetupReturnValue_DifferentParams(){
        $mock = new MegaMock(Int1::class);
        $mock->Yo(1)->willReturn('Hi1');
        $mock->Yo(2)->willReturn('Hi2');
        $this->assertEquals('Hi1', $mock->getObject()->Yo(1));
        $this->assertEquals('Hi2', $mock->getObject()->Yo(2));
    }

    /** @expectedException \Exception */
    public function test_NoRetValueSetup_ThrowsException(){
        $mock = new MegaMock(Int1::class);
        $mock->getObject()->Yo(1);
    }

    /** @expectedException \Exception */
    public function test_NoRetValueSetupProperly_ThrowsException(){
        $mock = new MegaMock(Int1::class);
        $mock->Yo(333)->willReturn(1);
        $mock->getObject()->Yo(1);
    }

    public function test_NullValueSetup(){
        $mock = new MegaMock(Int1::class);
        $mock->Yo(333);
        $this->assertEquals(null, $mock->getObject()->Yo(333));
    }


    public function test_SetupClassReturnValue_ActuallReturnsTheValue(){
        $mock = new MegaMock(Type1::class);
        $mock->Yo()->willReturn('Hi');
        $this->assertEquals('Hi', $mock->getObject()->Yo());

        $mock->Ya(543)->willReturn('Hi');
        $this->assertEquals('Hi', $mock->getObject()->Ya(543));
    }
}


class Type1 {
    public function Yo(){}
    public function Ya($p){}
}
interface Int1 {
    public function Yo();
}
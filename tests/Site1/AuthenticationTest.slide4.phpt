<?php
namespace Site1;

class AuthenticationTest extends \PHPUnit_Framework_TestCase
{
    /** @var Authentication */
    private $auth = null;
    /** @var LoggerDouble */
    private $logger = null;

    public function setUp(){
        /*$this->logger = new LoggerDouble();
        $userFinder = new UserFinderDouble();
        $this->auth = new Authentication($userFinder, $this->logger);*/
    }

    public function testLoginCorrectPassword() {
        $result = $this->auth->Auth('m@ex.com', 'qwerty');
        $this->assertTrue($result);
        $this->assertEquals("All good ;)", $this->logger->message);
    }

    public function testStub()
    {
        // Create a stub for the SomeClass class.
        $mock = $this->getMockBuilder(SomeInterface::class)->getMock();

        // Configure the stub.
        $mock->method('someMethod')->willReturn('foo');

        // Check that it works
        $this->assertEquals('foo', $mock->someMethod("hi"));
    }
}

interface SomeInterface {}
class SomeClass {
    public function __construct()
    {
        echo 'con';
    }
    public function someMethod($value) {
        echo 'some method', $value;
    }
}

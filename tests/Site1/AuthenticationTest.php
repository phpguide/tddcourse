<?php
namespace Site1;

class AuthenticationTest extends \PHPUnit_Framework_TestCase
{
    /** @var Authentication */
    private $auth = null;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $logger = null;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $repo = null;

    public function setUp(){

        $this->logger = $this->getMock(ILogger::class);
        $this->repo = $this->getMock(IUserFinder::class);
        $this->auth = new Authentication($this->repo, $this->logger);
    }

    public function testLoginCorrectPassword() {

        $user = new User("m@ex.com", 'qwerty');

        $this->repo
            ->expects($this->once())
            ->method('FindUserByMail')
            ->with($this->equalTo($user->email))
            ->willReturn($user);

        $this->logger
            ->expects($this->once())
            ->method('Log')
            ->with($this->stringContains("good"));

        $result = $this->auth->Auth($user->email, $user->password);

        $this->assertTrue($result);

    }

    public function testMockExpectations(){

        // List the methods that will have expectations
        $mock = $this->getMockBuilder(SomeClass::class)
            ->setMethods(['method_with_3_parameters'])
            ->getMock();

        // Set up the expectation for the method1() method
        // to be called only once and with the string 'something'
        $mock->expects($this->exactly(1))
            ->method('method_with_3_parameters')
            ->with(
                $this->greaterThan(5),
                $this->stringContains('man'),
                $this->anything()
            );

        $mock->method_with_3_parameters(6, 'superman', 'whatever' * 2);
    }
}

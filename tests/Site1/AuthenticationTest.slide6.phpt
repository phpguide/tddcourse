<?php
namespace Site1;

class AuthenticationTest extends \PHPUnit_Framework_TestCase
{
    /** @var Authentication */
    private $auth = null;
    /** @var ILogger */
    private $logger = null;
    /** @var IUserFinder */
    private $repo = null;

    public function setUp(){
        $this->logger = $this->getMockBuilder(ILogger::class)->getMock();
        $this->repo = $this->getMockBuilder(IUserFinder::class)->getMock();
        $this->auth = new Authentication($this->repo, $this->logger);
    }

    public function testLoginCorrectPassword() {

        $user = new User("m@ex.com", 'qwerty');
        $this->repo->method('FindUserByMail')->willReturn($user);

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

class SomeClass{
public function method_with_3_parameters($a, $b, $c) {}
}

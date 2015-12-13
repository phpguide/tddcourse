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
}

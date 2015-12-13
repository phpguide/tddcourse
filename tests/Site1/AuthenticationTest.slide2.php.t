<?php
namespace Site1;

class AuthenticationTest extends \PHPUnit_Framework_TestCase
{
    /** @var Authentication */
    private $auth = null;

    public function setUp(){
        $logger = new LoggerDouble();
        $userFinder = new UserFinderDouble();
        $this->auth = new Authentication($userFinder, $logger);
    }

    public function testLoginCorrectPassword() {
        $result = $this->auth->Auth('m@ex.com', 'qwerty');
        $this->assertTrue($result);
        // Assert that message was written to log ??
    }
}

class LoggerDouble implements ILogger{
    public function Log($string) { }
}

class UserFinderDouble implements IUserFinder{
    function FindUserByMail(string $mail) {
        return new User($mail, 'qwerty');
    }
}


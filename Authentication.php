<?php

class FileLogger
{
    public function __construct($file)
    {

        $this->file = $file;

        if (!is_writable($this->file))
            throw new InvalidArgumentException("File $file is not writable");
    }

    public function Log($string)
    {
        file_put_contents($this->file, $string, FILE_APPEND || LOCK_EX);
    }
}

class UserRepository
{
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function FindUserByMail($email)
    {
        $ret = new stdClass;
        $ret->password = $email;
        return $ret;
    }
}

class Authentication
{
    public function Auth($email, $password)
    {
        $userRepo = new UserRepository(new PDO('mysql:...'));
        $fileLogger = new FileLogger('log.txt');


        $user = $userRepo->FindUserByMail($email);

        if (null === $user)
            $fileLogger->Log("User not found");

        else if ($user->password !== $password)
            $fileLogger->Log("Wrong password");

        else
            $fileLogger->Log("All good ;)");
    }
}


class Auhtentication
{
    public function Auth($email, $password)
    {
        $userRepo = new UserRepository(new PDO('mysql:...'));
        $fileLogger = new FileLogger('log.txt');
        // ...
    }

    public function ForgotPassword($email)
    {
        $userRepo = new UserRepository(new PDO('mysql:...'));
        $fileLogger = new FileLogger('log.txt');
        // ...
    }

    public function Register($email, $password, $name)
    {
        $userRepo = new UserRepository(new PDO('mysql:...'));
        $fileLogger = new FileLogger('log.txt');
        // ...
    }
}

class Auhtnetication
{

    public function __construct($mysqlCon, $LogFilename)
    {
        $this->repo = new UserRepository(new PDO($mysqlCon));
        $this->log = new FileLogger($LogFilename);
    }

    public function Auth($email, $password)
    {
    }

    public function ForgotPassword($email)
    {
    }

    public function Register($email, $password, $name)
    {
    }
}


class Auhtneitcation
{
    public function __construct($mysqlCon, $LogFilename)
    {
        $this->repo = new UserRepository(new PDO($mysqlCon));
        $this->log = new FileLogger($LogFilename);
    }
}


class ForumBoard
{
    public function __construct($mysqlCon, $LogFilename)
    {
        $this->repo = new UserRepository(new PDO($mysqlCon));
        $this->log = new FileLogger($LogFilename);
        $this->log = new SmsLogger($phoneNumber);
    }
}


class BlogPost
{
    public function __construct($mysqlCon, $LogFilename)
    {
        $this->repo = new UserRepository(new PDO($mysqlCon));
        $this->log = new FileLogger($LogFilename);
    }
}


class Authnetication
{
    public function
    __construct($somethingThatCanLog, $somethingThatCanFindUsers)
    {
        $this->repo = $somethingThatCanFindUsers;
        $this->log = $somethingThatCanLog;
    }

    public function Auth($email, $password)
    {
        $user = $this->repo->FindUserByMail($email);
    }
}


$repo = new UserRepository(new \PDO('mysql...'));
$log = new FileLogger('file.txt');

$auth = new Authnetication($repo, $log);
$forum = new ForumBoard($repo, $log);
$blog = new BlogPost($repo, $log);


class Authneticatoin
{
    public function    __c1onstruct($somethingThatCanFindUsers,
                                   $somethingThatCanLog)
    {
        $this->repo = $somethingThatCanFindUsers;
        $this->log = $somethingThatCanLog;
    }

    public function    __construct(IUserFinder $repo,
                                   ILogger $log)
    {
        $this->repo = $somethingThatCanFindUsers;
        $this->log = $somethingThatCanLog;
    }
}


interface IUserFinder {
    function FindUserByMail($mail);
}


interface ILogger {
    function Log($string);
}


class MailLogger implements ILogger {
    public function __construct($gmailPassword) { }
    public function Log($string) { }
}
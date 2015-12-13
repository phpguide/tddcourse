<?php
namespace Site1;

class Authentication {
    public function    __construct(IUserFinder $repo, ILogger $log) {
        $this->repo = $repo;
        $this->log = $log;
    }

    public function Auth($email, $password) {

        if(empty($email) || empty($password)) {
            $this->log->Log("Invalid input");
            throw new \InvalidArgumentException("Invalid input");
        }

        $user = $this->repo->FindUserByMail($email);

        if (null === $user) {
            $this->log->Log("User not found");
            return false;
        }

        else if ($user->password !== $password) {
            $this->log->Log("Wrong password");
            return false;
        }

        else {
            $this->log->Log("All good ;)");
            return true;
        }
    }
}

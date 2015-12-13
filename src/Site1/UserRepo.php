<?php
namespace Site1;

class UserRepo implements IUserDao
{
    /** @var \PDO */
    private $conn;

    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

    public function FindUserByMail($mail)
    {
        $query = 'SELECT * FROM users WHERE mail = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$mail]);

        $stmt->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            User::class,
            [null, null]
        );

        return $stmt->fetch();

    }

    public function SaveUser(User $user)
    {
        if ($user == null)
            throw new \InvalidArgumentException("user is null");

        if (null == $user->id)
            $this->createNewUser($user);
        else
            $this->updateExistingUser($user);
    }

    private function createNewUser(User $user)
    {
        $query = "INSERT INTO users (mail, pass) VALUES (:mail, :pass)";
        $stmt = $this->conn->prepare($query);
        $data = [':mail' => $user->mail, ':pass' => $user->pass];
        $wasSuccessful = $stmt->execute($data);

        if ($wasSuccessful)
            $user->id = $this->conn->lastInsertId();
        else
            throw new \PDOException("Failed to insert user:" . $this->conn->errorInfo()[2]);

    }

    private function updateExistingUser(User $user)
    {
        $query = "UPDATE users SET mail = :mail, pass = :pass WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $data = [':mail' => $user->mail, ':pass' => $user->pass, ':id' => $user->id];
        $stmt->execute($data);
    }
}
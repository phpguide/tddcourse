<?php
namespace Site1;

class UserRepoTest
    extends \PHPUnit_Extensions_Database_TestCase
{

    const mysql_db = 'dbunit';
    const dsn = "mysql:host=33.33.33.11;dbname=".self::mysql_db;
    const mysql_user = 'root';
    const mysql_pass = '';
    const options = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];
    const create_users_table =
        'DROP TABLE IF EXISTS users;
         CREATE TABLE users (
         `id` SERIAL,
         `mail` varchar(20) UNIQUE,
         `pass` varchar(20))';

    /** @var UserRepo */
    private $repo;
    private $pdo;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // create mysql connection
        $this->pdo = new \PDO(self::dsn, self::mysql_user, self::mysql_pass, self::options);

        // Create database tables. PHPUnit expects schema to exist
        $this->pdo->exec(self::create_users_table);
    }

    public function setUp()
    {
        parent::setUp(); // otherwise overriding necessary functionality

        $this->repo = new UserRepo($this->pdo);
    }

    public function testFindUser_FindsExistingUserByMail(){
        $found = $this->repo->FindUserByMail('alex@example.com');
        $this->assertInstanceOf(User::class, $found);

        $this->assertEquals(1, $found->id);
        $this->assertEquals('alex@example.com', $found->mail);
        $this->assertEquals('qwerty', $found->pass);
    }

    public function testFindUser_NonExistingUser_ReturnsFalsue(){
        $found = $this->repo->FindUserByMail('nobody');
        $this->assertEquals(null, $found);
    }

    public function testSaveUser_SavesNewUser(){
        $newUser = new User("new@sthaoestuhaoeus", "abc");

        $this->repo->SaveUser($newUser);

        $expectedRowCount = $this->getDataSet()->getTable('users')->getRowCount() + 1;
        $actualRowCount = $this->getConnection()->getRowCount('users');

        $this->assertEquals($expectedRowCount, $actualRowCount);

        $expectedSet = $this->createFlatXMLDataSet(__DIR__.'/expected_after_insert.xml');
        $actualSet = $this->getConnection()->createDataSet(['users']);
        $this->assertDataSetsEqual($expectedSet, $actualSet);
    }

    public function testSaveUser_UpdateExisting(){
        $user = new User("newvalue@gmail.com", "newpass");
        $user->id = 1; // updating user with id = 1

        $this->repo->SaveUser($user);

        $expectedRowCount = $this->getDataSet()->getTable('users')->getRowCount();
        $actualRowCount = $this->getConnection()->getRowCount('users');
        $this->assertEquals($expectedRowCount, $actualRowCount);

        $updatedUser = $this->repo->FindUserByMail($user->mail);
        $this->assertEquals($user, $updatedUser);
    }

    /** @expectedException \PDOException */
    public function testSaveUser_NewUserInsertionFails_ThrowsException(){
        $this->repo->SaveUser(new User('alex@example.com', null));
    }

    /**
     * Returns the test database connection.
     * @return \PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection() {
        return $this->createDefaultDBConnection($this->pdo, self::mysql_db);
    }

    /**
     * Returns the test dataset.
     * @return \PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet() {
        return $this->createFlatXMLDataSet(__DIR__.'/dataset.xml');
    }

    /** Not necessary - Clean database after running tests */
    protected function getTearDownOperation() {
        return \PHPUnit_Extensions_Database_Operation_Factory::TRUNCATE();
    }
}

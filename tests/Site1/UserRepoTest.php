<?php
namespace Site1;

class UserRepoTestBase extends DbTestBase
{
    /** @var UserRepo */
    private $repo;

    public function setUp()
    {
        parent::setUp(); // otherwise overriding necessary functionaity
        $this->repo = new UserRepo($this->pdo);
    }

    public function testFindUser_FindsExistingUserByMail()
    {
        $found = $this->repo->FindUserByMail('alex@example.com');
        $this->assertInstanceOf(User::class, $found);

        $this->assertEquals(1, $found->id);
        $this->assertEquals('alex@example.com', $found->mail);
        $this->assertEquals('qwerty', $found->pass);
    }

    public function testSaveUser_SavesNewUser()
    {
        $newUser = new User("new@example.org", "abc");

        $this->repo->SaveUser($newUser);

        $expectedRowCount = $this->getDataSet()->getTable('users')->getRowCount() + 1;
        $actualRowCount = $this->getConnection()->getRowCount('users');

        $this->assertEquals($expectedRowCount, $actualRowCount);

        $expectedSet = $this->createFlatXMLDataSet(__DIR__ . '/expected_after_insert.xml');
        $actualSet = $this->getConnection()->createDataSet(['users']);
        $this->assertDataSetsEqual($expectedSet, $actualSet);
    }

    /* Only use this if you want a test specific dataset
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__ . '/dataset.xml');
    }
    */
}


<?php
namespace Site1;

abstract class DbTestBase extends \PHPUnit_Extensions_Database_TestCase
{
    const options = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];

    /** @var \PDO */
    protected $pdo = null;
    protected $conn = null;

    final protected function getConnection()
    {
        if($this->pdo == null) {
            $this->pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], self::options);
            $this->createTables();
            $this->conn = $this->createDefaultDBConnection($this->pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }

    /**
     * Returns the test dataset.
     * @return \PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet() {
        return $this->createFlatXMLDataSet(__DIR__.'/dataset.xml');
    }

    private function createTables(){
        $this->pdo->exec(file_get_contents(__DIR__.'/schema.sql'));
    }

    /** Not necessary - Clean database after running tests */
    protected function getTearDownOperation() {
        return \PHPUnit_Extensions_Database_Operation_Factory::TRUNCATE();
    }


}
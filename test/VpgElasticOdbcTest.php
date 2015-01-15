<?php
/**
 * User: cjimenez
 * Date: 07/01/15 18:01
 */
//require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../env.php';

class VpgElasticOdbcTest extends PHPUnit_Framework_TestCase {

    private $timeStart;
    
    /**
     * Testing connection to hive DB
     */
    public function testConnection() {
        $db = $this->connect();
        $this->assertEquals(get_class($db), 'PDO');
    }

    /**
     * Testing a show tables
     * @depends testConnection
     */
    public function testShowTable() {
        $result = $this->connect()->query('show tables');
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select
     * @depends testConnection
     */
    public function testSelect() {
        $statement = $this->connect()->query('SELECT * FROM voyageprive_es.member limit 10');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select with where clause
     *
     * @depends testConnection
     */
    public function testSelectWithCondition() {
        $result = $this->connect()
            ->query('SELECT * FROM voyageprive_es.member where member_id > 100 limit 10')
            ->fetchAll(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select with columns
     *
     * @depends testConnection
     */
    public function testSelectWithColumns() {
        $result = $this->connect()
            ->query('SELECT member_id FROM voyageprive_es.member limit 10')
            ->fetchAll(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($result);
    }
    

    /**
     * @return \PDO
     */
    private function connect()
    {
        $db = new PDO(
            "odbc:DSN=" . ODBC_DATA_CONNECTION . ";HOST=" . DATA_SERVER . ";port=" . DATA_PORT,
            HIVE_USER,
            HIVE_PASS
        );
        return $db;
    }
    
    protected function setUp()
    {
        $this->timeStart = microtime(true);
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    protected function tearDown()
    {
        echo "Elapsed Time : " . round(microtime(true) - $this->timeStart, 2) . "\n";
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

}

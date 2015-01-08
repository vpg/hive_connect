<?php
/**
 * User: cjimenez
 * Date: 07/01/15 18:01
 */
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../env.php';
require_once __DIR__.'/../Library/VpgPdo.php';

class VpgPdoTest extends PHPUnit_Framework_TestCase {

    /**
     * Testing connection to hive DB
     */
    public function testConnection() {
        $db = $this->connect();
        $this->assertEquals(get_class($db), 'VpgPdo');
    }

    /**
     * Testing a show table
     */
    public function testShowTable() {
        $result = $this->connect()->query('show tables');
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select
     */
    public function testSelect() {
        $result = $this->connect()->query('SELECT * FROM voyageprive_daily.city limit 10');
        $this->assertNotEmpty($result);
    }

    /**
     * Connecting to the Hive DB
     *
     * @return \VpgPdo
     */
    private function connect()
    {
        $db = new VpgPdo(
            'hive:' .
            'host=' . HIVE_SERVER . ';' .
            'port=' . HIVE_PORT . ';',
            HIVE_USER,
            HIVE_PASS
        );
        return $db;
    }
}

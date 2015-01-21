<?php
/**
 * User: cjimenez
 * Date: 07/01/15 18:01
 */
require_once __DIR__.'/../env.php';
require_once __DIR__.'/../vendor/autoload.php';

use \Vpg\Driver\Hive;
use \Vpg\Library\VpgDataAccess;

class VpgDataAccessTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Hive
     */
    public $driverHive = null;

    /**
     * @var VpgDataAccess
     */
    public $da = null;
    
    /**
     * @return Hive
     */
    public function getDriverHive()
    {
        if (is_null($this->driverHive)) {
            $this->driverHive = new Hive();
        }
        return $this->driverHive;
    }
    
    /**
     * @param Hive $driverHive
     */
    public function setDriverHive($driverHive)
    {
        $this->driverHive = $driverHive;
    }
    
    /**
     * @return VpgDataAccess
     */
    public function getDa()
    {
        if (is_null($this->da)) {
            $this->da = new VpgDataAccess($this->getDriverHive());
        }
        return $this->da;
    }
    
    /**
     * @param VpgDataAccess $da
     */
    public function setDa($da)
    {
        $this->da = $da;
    }

    /**
     * Testing connection to hive DB
     */
    public function testOpenConnection() {
        $this->getDa();
    }

    /**
     * Testing a show tables
     * @depends testOpenConnection
     */
    public function testShowTable() {
        $result = $this->getDa()->query('show tables');
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select
     * @depends testOpenConnection
     */
    public function testSelect() {
        $res = $this->getDa()->query('SELECT * FROM voyageprive_daily.city limit 10');
        $this->assertNotEmpty($res);
    }

    /**
     * Testing a select with where clause
     *
     * @depends testOpenConnection
     */
    public function testSelectWithCondition() {
        $result = $this->getDa()
            ->query('SELECT * FROM voyageprive_daily.city where city_id > 100 limit 10');
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select with columns
     *
     * @depends testOpenConnection
     */
    public function testSelectWithColmuns() {
        $result = $this->getDa()
            ->query('SELECT city_id, name FROM voyageprive_daily.city limit 10')
            ;
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select with Group by
     * @depends testOpenConnection
     */
    public function testSelectWithGroupBy() {
        $result = $this->getDa()->query(
            'SELECT country_id, count(*)
             FROM voyageprive_daily.city
             GROUP BY country_id');
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select with Aggregation
     * @depends testOpenConnection
     */
    public function testSelectWithAggregation() {
        $result = $this->getDa()->query(
            'SELECT country_id, count(*)
             FROM voyageprive_daily.city
             GROUP BY country_id limit 10
             ')
        ;
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select with join
     *
     * @var string $type
     *
     * @depends testOpenConnection
     */
    private function selectWithJoin($type) {
        $result = $this->getDa()
            ->query(
            "SELECT *
            FROM voyageprive_daily.city AS ci
            $type JOIN voyageprive_daily.country AS co ON ci.country_id = co.country_id
            limit 10")
        ;
        $this->assertNotEmpty($result);
    }

    /**
     * Testing a select with left join
     *
     * @depends testOpenConnection
     */
    public function testSelectWithInnerJoin() {
        $this->selectWithJoin('inner');
    }

    /**
     * Testing a select with left join
     *
     * @depends testOpenConnection
     */
    public function testSelectWithLeftJoin() {
        $this->selectWithJoin('left');
    }

    /**
     * Testing a select with right join
     *
     * @depends testOpenConnection
     */
    public function testSelectWithRightJoin() {
        $this->selectWithJoin('right');
    }
}

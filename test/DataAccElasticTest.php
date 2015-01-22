<?php
/**
 * User: cjimenez
 * Date: 15/01/15 16:45
 */
require_once __DIR__.'/../env.php';
require __DIR__.'/../vendor/autoload.php';

use \Vpg\Library\DataAccess;
use \Vpg\Driver\Elastic;

class DataAccElasticTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Elastic
     */
    public $driver = null;

    /**
     * @var DataAccess
     */
    public $da = null;

    /**
     * @return \Vpg\Driver\Hive
     */
    public function getDriver()
    {
        if (is_null($this->driver)) {
            $this->driver = new Elastic(DATA_SERVER, ELASTIC_PORT);
        }
        return $this->driver;
    }

    /**
     * @param Elastic $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return DataAccess
     */
    public function getDa()
    {
        if (is_null($this->da)) {
            $this->da = new DataAccess($this->getDriver());
        }
        return $this->da;
    }

    /**
     * @param DataAccess $da
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
     * Testing a select
     * @depends testOpenConnection
     */
    public function testSearch() {
        $res = $this->getDa()->query([
            'index' => 'front',
            'type'  => 'device',
            'body' => [
                'query' => [
                    'match' => [
                        'type' => 'IOS'
                    ]
                ]
            ]
        ]);
        $this->assertNotEmpty($res);
    }
}

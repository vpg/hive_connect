<?php
/**
 * User: cjimenez
 * Date: 15/01/15 16:45
 */
require_once __DIR__.'/../env.php';
require __DIR__.'/../vendor/autoload.php';

use \Vpg\Library\VpgDataAccess;
use \Vpg\Driver\Elastic;

class VpgDataAccElasticTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Elastic
     */
    public $driver = null;

    /**
     * @var VpgDataAccess
     */
    public $da = null;

    /**
     * @return \Vpg\Driver\Hive
     */
    public function getDriver()
    {
        if (is_null($this->driver)) {
            $this->driver = new Elastic();
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
     * @return VpgDataAccess
     */
    public function getDa()
    {
        if (is_null($this->da)) {
            $this->da = new VpgDataAccess($this->getDriver());
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

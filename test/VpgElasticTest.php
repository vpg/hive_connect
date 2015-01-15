<?php
/**
 * User: cjimenez
 * Date: 15/01/15 16:45
 */
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../Library/VpgDataAccess.php';
require_once __DIR__.'/../Driver/Elastic.php';
require_once __DIR__.'/../env.php';

class VpgElasticTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \Driver\Elastic
     */
    public $driver = null;

    /**
     * @var VpgDataAccess
     */
    public $da = null;

    /**
     * @return \Driver\Hive
     */
    public function getDriver()
    {
        if (is_null($this->driver)) {
            $this->driver = new \Driver\Elastic();
        }
        return $this->driver;
    }

    /**
     * @param \Driver\Elastic $driver
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

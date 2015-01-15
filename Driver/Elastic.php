<?php
/**
 * User: cjimenez
 * Date: 15/01/15 16:31
 */
namespace Driver;

use Elasticsearch\Client;

require_once 'iDriver.php';

class Elastic implements \iDriver {

    /**
     * @var \Elasticsearch\Client
     */
    public $client;
    
    public function connect()
    {
        $params = array();
        $params['hosts'] = array ('http://' . DATA_SERVER . ':' . DATA_PORT . '/');
        $this->client = new Client($params);
    }
    
    public function query($statement)
    {
        return $this->client->search($statement);
    }
}
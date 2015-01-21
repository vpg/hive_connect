<?php
/**
 * User: cjimenez
 * Date: 15/01/15 16:31
 */
namespace Vpg\Driver;

use \Elasticsearch\Client;


class Elastic implements iDriver {

    /**
     * @var \Elasticsearch\Client
     */
    public $client = null;

    /**
     * Connecting to the Elastic search database
     */
    public function connect()
    {
        $params = array();
        $params['hosts'] = array ('http://' . DATA_SERVER . ':' . DATA_PORT . '/');
        $this->client = new Client($params);
    }

    /**
     * Search into the elastic search DB and returns the result
     *
     * @param string $statement
     *
     * @return array
     */
    public function query($statement)
    {
        return $this->client->search($statement);
    }
    
    /**
     * Indicates if the connection is active or not
     *
     * @return boolean
     */
    public function isConnected()
    {
        return ($this->client->transport->getConnection()->isAlive());
    }
    
    /**
     * Close the connection
     *
     * @return boolean
     */
    public function closeConnection()
    {
        $this->client->transport->getConnection()->markDead();
        return true;
    }
}
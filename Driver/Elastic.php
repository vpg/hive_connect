<?php
/**
 * User: cjimenez
 * Date: 15/01/15 16:31
 */
namespace Vpg\Driver;

use \Elasticsearch\Client;


class Elastic implements iDriver {

    public $server = null;
    public $port = null;
    
    /**
     * @var \Elasticsearch\Client
     */
    public $client = null;
    
    
    /**
     * @param string $server Server address (ip or dns name)
     * @param int    $port   Port to connect
     * @param string $user   Username to connect
     * @param string $pass   Password to connect
     * @param string $name   Connection name
     *
     */
    public function __construct($server, $port, $user = null, $pass = null, $name = null)
    {
        $this->server = $server;
        $this->port = $port;
    }

    /**
     * Connection on the desired driver
     *
     * @param string $server Server address (ip or dns name)
     * @param int    $port   Port to connect
     * @param string $user   Username to connect
     * @param string $pass   Password to connect
     * @param string $name   Connection name
     *
     * @return mixed
     */
    public function connect()
    {
        $params = array();
        $params['hosts'] = array ('http://' . $this->server . ':' . $this->port . '/');
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
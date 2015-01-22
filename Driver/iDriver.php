<?php
/**
 * User: cjimenez
 * Date: 14/01/15 15:16
 */

namespace Vpg\Driver;

interface iDriver {

    /**
     * @param string $server Server address (ip or dns name)
     * @param int    $port   Port to connect
     * @param string $user   Username to connect
     * @param string $pass   Password to connect
     * @param string $name   Connection name
     *
     */
    public function __construct($server, $port, $user, $pass, $name = null);
    
    /**
     * Connection on the desired driver
     *
     * @return mixed
     */
    public function connect();

    /**
     * Executing a query on the selcted connection and returns the result
     *
     * @param string $statement
     *
     * @return mixed
     */
    public function query($statement);

    /**
     * Indicates if the connection is active or not
     *
     * @return boolean
     */
    public function isConnected();

    /**
     * Close the connection
     *
     * @return boolean
     */
    public function closeConnection();
}
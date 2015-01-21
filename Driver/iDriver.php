<?php
/**
 * User: cjimenez
 * Date: 14/01/15 15:16
 */

namespace Vpg\Driver;

interface iDriver {

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
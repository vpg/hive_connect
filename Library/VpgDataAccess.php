<?php
/**
 * User: cjimenez
 * Date: 14/01/15 15:20
 */

class VpgDataAccess {
    
    public $driver;

    /**
     * Constructing data access
     *
     * @param $driver
     */
    function __construct($driver)
    {
        $this->driver = $driver;
        $this->driver->connect();
    }

    /**
     * Execute a SQL query and returns the result as array
     *
     * @param $statement
     *
     * @throws Exception
     *
     * @return int
     */
    public function query($statement)
    {
        return $this->driver->query($statement);
    }
}
<?php
/**
 * User: cjimenez
 * Date: 14/01/15 15:15
 */

namespace Vpg\Driver;

class Hive implements iDriver {

    public $connectionName = null;
    public $server = null;
    public $port = null;
    public $user = null;
    public $pass = null;
    
    /**
     * @var \PDO
     */
    public $db = null;
    
    /**
     * @param string $server Server address (ip or dns name)
     * @param int    $port   Port to connect
     * @param string $user   Username to connect
     * @param string $pass   Password to connect
     * @param string $name   Connection name
     *
     */
    public function __construct($server, $port, $user, $pass, $name = null)
    {
        $this->server           = $server;
        $this->user             = $user;
        $this->pass             = $pass;
        $this->port             = $port;
        $this->connectionName   = $name;
    }

    /**
     * Get the PDO
     *
     * @return \PDO
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Store the PDO
     *
     * @param \PDO $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }
    
    /**
     * Connection on the desired driver
     *
     * @return mixed
     */
    public function connect()
    {
        if (is_null($this->db)) {
            $db = new \PDO(
                "odbc:DSN=" . $this->connectionName . ";HOST=" . $this->server . ";port=" . $this->port,
                $this->user,
                $this->pass
            );
            $this->setDb($db);
        }
    }

    /**
     * Indicates if the connection is active or not
     *
     * @return boolean
     */
    public function isConnected()
    {
        return !is_null($this->db);
    }
    
    /**
     * Close the connection
     *
     * @return boolean
     */
    public function closeConnection()
    {
        $this->db = null;
        return true;
    }

    /**
     * Execute a query an returns an array
     *
     * @param string $statement
     *
     * @return array
     */
    public function query($statement)
    {
        $statement = $this->db->query($statement);
        if ($statement) {
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $statement = null; // Mandatory for closing connection
            return $result;
        } else {
            return [];
        }
    }
}
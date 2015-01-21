<?php
/**
 * User: cjimenez
 * Date: 14/01/15 15:15
 */

namespace Vpg\Driver;

class Hive implements iDriver {

    /**
     * @var \PDO
     */
    public $db = null;
    
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
     * Connect to the server
     */
    public function connect()
    {
        if (is_null($this->db)) {
            $db = new \PDO(
                "odbc:DSN=" . ODBC_DATA_CONNECTION . ";HOST=" . DATA_SERVER . ";port=" . DATA_PORT,
                HIVE_USER,
                HIVE_PASS
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
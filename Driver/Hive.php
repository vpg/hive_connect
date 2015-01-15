<?php
/**
 * User: cjimenez
 * Date: 14/01/15 15:15
 */

namespace Driver;

require_once 'iDriver.php';

class Hive implements \iDriver {

    /**
     * @var PDO
     */
    public $db = null;
    
    /**
     * @return PDO
     */
    public function getDb()
    {
        return $this->db;
    }
    
    /**
     * @param PDO $db
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
     * Execute a query an returns an array
     *
     * @param $statement
     *
     * @return array
     */
    public function query($statement)
    {
        $statement = $this->db->query($statement);
        if ($statement) {
            return $statement->fetchAll();
        } else {
            return [];
        }
    }
}
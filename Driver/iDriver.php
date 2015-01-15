<?php
/**
 * User: cjimenez
 * Date: 14/01/15 15:16
 */

interface iDriver {

    /**
     * Based on PDO fetch styles : Way of returning data
     *
     * @link http://php.net/manual/fr/pdostatement.fetch.php
     */
    const FETCH_OBJ = 1;
    const FETCH_ASSOC = 2;
    const FETCH_BOTH = 3;

    public function connect();
    public function query($statement);
}
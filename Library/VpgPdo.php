<?php
/**
 * User: cjimenez
 * Date: 07/01/15 14:22
 */

require_once __DIR__ . '/../vendor/automattic/php-thrift-sql/ThriftSQL.phar';

class VpgPdo extends PDO {

    /**
     * @param $dsn
     * @param $username
     * @param $passwd
     * @param $options
     */
    public function __construct($dsn, $username, $passwd, $options)
    {
        if (strpos('hive:', $dsn) == 0) {
            return new \ThriftSQL\Hive( 'vp-ol-fusion01.recette1.melt.vp.lan', 10000, 'user', 'pass' );
        } else {
            return parent::__construct($dsn, $username, $passwd, $options);
        }
    }

}
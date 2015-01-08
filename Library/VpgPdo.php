<?php
/**
 * User: cjimenez
 * Date: 07/01/15 14:22
 */

require_once __DIR__ . '/../vendor/automattic/php-thrift-sql/src/autoload.php';

class VpgPdo extends PDO {

    /**
     * @var bool
     */
    var $isHive = false;

    /**
     * @var \ThriftSQL\Hive
     */
    var $hiveDb = null;

    /**
     * @param \ThriftSQL\Hive $hiveDb
     */
    public function setHiveDb(\ThriftSQL\Hive $hiveDb)
    {
        $this->hiveDb = $hiveDb;
    }

    /**
     * @return boolean
     */
    public function isHive()
    {
        return $this->isHive;
    }

    /**
     * @param $dsn
     * @param $username
     * @param $passwd
     * @param $options
     */
    public function __construct($dsn, $username, $passwd, $options = null)
    {
        if (strpos('hive:', $dsn) == 0) {
            $this->isHive = true;
            $infos = $this->getDsnInfos($dsn);

            $db =  new \ThriftSQL\Hive( $infos['host'], $infos['port'], $username, $passwd );
            $this->setHiveDb($db);
            $db->connect();

            return $db;
        } else {
            return parent::__construct($dsn, $username, $passwd, $options);
        }
    }

    private function getDsnInfos($dsn)
    {
        $aDsn = explode(':', $dsn);
        $aInfosTmp = explode(';', $aDsn[1]);
        $aInfos = [];
        foreach($aInfosTmp as $info) {
            if (!empty($info)) {
                $aInfo = explode('=', $info);
                $aInfos[$aInfo[0]] = $aInfo[1];
            }
        }
        return $aInfos;
    }

    public function query ($statement) {
        if ($this->isHive()) {
            return $this->hiveDb->queryAndFetchAll($statement);
        } else {
            return parent::query($statement);
        }
    }
}
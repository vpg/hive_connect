<?php
/**
 * User: cjimenez
 * Date: 07/01/15 11:46
 */

error_reporting(E_ALL);


require_once __DIR__ . '/../vendor/automattic/php-thrift-sql/src/autoload.php';
$hive = new \ThriftSQL\Hive( 'vp-ol-fusion01.recette1.melt.vp.lan', 10000, 'hue', 'hue' );
var_dump($hive);

//
//
//$hiveTables = $hive
//    ->connect()
//    ->queryAndFetchAll( 'SHOW DATABASES' );
//var_dump( $hiveTables );

$hive->connect();
$hive->queryAndFetchAll( 'use voyageprive_daily' );
$res = $hive->queryAndFetchAll( 'SELECT * from voyageprive_daily.member limit 10;' );

var_dump($res);

echo "Hello Fusion";
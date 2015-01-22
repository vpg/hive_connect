# Hive connect


1. Aim

  This project is extending PDO in order to be able to retrieve data from Hive

2. Pre-requisites

2.1. Create an env.php with following lines
```PHP
  <?php
  // Technology choice
  define('DATA_TECHNO', 'ELASTIC');

  // Hive Access config
  define('HIVE_PORT', 10000);
  define('HIVE_USER', 'hue');
  define('HIVE_PASS', 'hue');

  // Impala Access config
  define('IMPALA_PORT', 25020);
  define('IMPALA_USER', 'hue');
  define('IMPALA_PASS', 'hue');

  // Elastic Search
  define('ELASTIC_PORT', 9200);

  // Common config
  define('DATA_SERVER', 'vp-ol-fusion01.recette1.melt.vp.lan');
  define('ODBC_DATA_CONNECTION', 'My' . ucfirst(DATA_TECHNO));
  define('DATA_PORT', constant(DATA_TECHNO.'_PORT'));

  // Environment variables
  putenv('ODBCSYSINI=/etc');
  putenv('ODBCINI=/etc/odbc.ini');
  putenv('SIMBAINI=/opt/cloudera/' . strtolower(DATA_TECHNO) . 'odbc/lib/64/cloudera.' . strtolower(DATA_TECHNO) . 'odbc.ini');
  putenv('CLOUDERAIMPALAINI=/opt/cloudera/' . strtolower(DATA_TECHNO) . 'odbc/lib/64/cloudera.' . strtolower(DATA_TECHNO) . 'odbc.ini');
  putenv('LD_PRELOAD=/usr/lib/x86_64-linux-gnu/libodbcinst.so.1');
  putenv('LD_LIBRARAY_PATH=/usr/lib/x86_64-linux-gnu');
```


2.2. Composer

Install composer dependancies by running : sudo composer install

    
2.3 Install ODBC Driver for hive
    
Download the correct version here : http://www.cloudera.com/content/cloudera/en/downloads/connectors/hive/odbc/hive-odbc-v2-5-13.html

Follow the installation guide : http://www.cloudera.com/content/cloudera/en/documentation/connectors/latest/PDF/Cloudera-ODBC-Driver-for-Apache-Hive-Install-Guide.pdf

3 Tests

  You can run unit tests by running : 
  - phpunit test/VpgDataAccessTest.php
  - phpunit test/ElasticOdbcTest.php
  - phpunit test/VpgElasticTest.php
  - phpunit test/VpgHiveTest.php

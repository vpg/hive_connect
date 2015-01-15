# Hive connect


1. Aim

  This project is extending PDO in order to be able to retrieve data from Hive

2. Pre-requisites

  2.1. Create an env.php with following lines
```PHP
  <?php
  define('HIVE_SERVER', 'vp-ol-fusion01.recette1.melt.vp.lan');
  define('HIVE_PORT', 10000);
  define('HIVE_USER', 'hue');
  define('HIVE_PASS', 'hue');
```
 
  2.2. Composer

  Install composer dependancies by running : sudo composer install

3 Tests

  You can run unit tests by running : phpunit test/VpgPdoTest.php
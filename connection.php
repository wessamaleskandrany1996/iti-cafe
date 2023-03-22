<?php 
define('BD_TYPE','mysql');
define('DB_NAME','cafeteriaphp');
define('DB_USER','root');
define('DB_PASSWD','');
define('DB_HOST','localhost');
$string = BD_TYPE .":host=".DB_HOST.";dbname=".DB_NAME.";";
$con = new PDO($string,DB_USER,DB_PASSWD);



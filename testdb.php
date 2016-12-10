<?php

$dbhost = 'localhost';
$dbuser = 'jp000436';
$dbpass = 'xahG2yi9Oi2x'; // NOTA: Reemplace password por el password de su cuenta de hosting

echo $dbhost;
echo $dbuser;
echo $dbpass;

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Ocurrió un error al conectarse al servidor mysql');

$dbname = 'jp000436_villadelparque30';
mysql_select_db($dbname);

?> 
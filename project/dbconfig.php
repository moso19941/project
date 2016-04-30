<?php
$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "";
$dbname = "projectweb";

mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 
mysql_select_db($dbname) or die('database selection problem');

//echo "<br><h3 class='bg-success' >Succfully connected to the database </h3><br>";
?>
<?php

$dbhost=""; // Host name
$dbusername=""; // Mysql username
$dbpassword=""; // Mysql password
$db_name=""; // Database name

// Connect to server and select databse.
mysql_connect("$dbhost", "$dbusername", "$dbpassword") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");
?>

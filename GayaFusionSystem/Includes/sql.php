<?php
$host = "localhost";
$username = "root";
$password = "";
$databasename = "gayafusionall";
$cn = mysql_connect($host, $username, $password) or die("Wrong Connection ... !!");
mysql_select_db($databasename, $cn) or die("Database Error");
?>
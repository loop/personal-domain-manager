<?php

/** database config **/
$database_host = "localhost";
$database_username = "user";
$database_password = "password";
$database_name = "name";

/** connect to database **/
@mysql_connect($database_host, $database_username, $database_password) or die('Unable to connect to database.');
@mysql_select_db($database_name) or die('Unable to connect to database.');


?>
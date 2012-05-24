<?php

/** start sessions **/
@session_start();

/** include config files **/
include("configs/config_general.php");
include("configs/database_config.php");
include("configs/smarty_config.php");

/** include function files **/
include("functions/functions_general.php");
include("functions/functions_email.php");
include("functions/functions_mysql.php");

/** include class files **/
include("classes/class_domains.php");

/** initiate classes **/
$domains = new Domains();

?>
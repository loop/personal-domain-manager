<?php

/** include header **/
include("header.php");

/** unset sessions **/
unset($_SESSION['logged_in']);

/** redirect **/
redirect($_CONFIG['paths']['base_url'] . '/login.php');

?>
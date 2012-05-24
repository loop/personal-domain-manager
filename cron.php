<?php

/** include header **/
include("header.php");

/** check for expired domains **/
$domains->check_expired(true);

/** check for expiring domains **/
$domains->check_expiring(true);

?>
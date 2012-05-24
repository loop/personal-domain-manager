<?php

/** include required files **/
include(dirname(__FILE__) . '/includes/common.php');

/** check if page & page title variable exists **/
$page = isset($page) ? $page : '';
$page_title = isset($page_title) ? $page_title : '';

/** check if user is logged in **/
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true)
{
    /** send to login.php **/
	redirect($_CONFIG['paths']['base_url'] . '/login.php');
	
	/** exit **/
	exit();
}

?>
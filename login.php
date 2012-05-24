<?php

/** include commons **/
include('./includes/common.php');

/** set page name **/
$page = 'login';

/** attempt to login **/
if(isset($_POST['login']))
{
    /** check for blank fields **/
	if(empty($_POST['username']) || empty($_POST['password']))
	{
	    $is_error = 1;
		$error_message = 'Please fill in all fields.';
	}else
	
	/** check username and password **/
	if($_POST['username'] != $_CONFIG['login']['username'] || $_POST['password'] != $_CONFIG['login']['password'])
	{
	    $is_error = 1;
		$error_message = 'Incorrect username or password.';
	}else
	
	/** no error **/
	if($is_error != 1)
	{
	    /** set sessions **/
		$_SESSION['logged_in'] = true;
		
		/** redirect **/
		redirect($_CONFIG['paths']['base_url']);
		
		/** exit **/
		exit;
	}
}

/** include footer **/
include("footer.php");

?>
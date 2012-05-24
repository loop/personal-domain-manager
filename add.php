<?php

/** include header **/
include("header.php");

/** set page name **/
$page = 'add';

/** add domain **/
if(isset($_POST['add']))
{
    /** pass domain to domain class **/
	$domains->add_domain($_POST['domain']);
	$is_error = $domains->is_error;
	$error_message = $domains->error_message;
}

/** set smarty variables **/
$smarty->assign('is_error', $is_error);
$smarty->assign('error_message', $error_message);

/** include footer **/
include("footer.php");

?>
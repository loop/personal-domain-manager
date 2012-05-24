<?php

/** assign global smarty variables **/
$smarty->assign('lang', $_LANG);
$smarty->assign('config', $_CONFIG);
$smarty->assign('page_title', isset($page_title) ? $page_title : '');
$smarty->assign('is_error', isset($is_error) ? $is_error : '');
$smarty->assign('error_message', isset($error_message) ? $error_message : '');
$smarty->assign('success', isset($success) ? $success : '');

/** display template file **/
$smarty->display("$page.tpl");

?>
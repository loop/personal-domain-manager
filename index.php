<?php

/** include header **/
include("header.php");

/** set page name **/
$page = 'index';

/** initiate pagination class **/
include "./includes/classes/class_paginate.php";
$paginate = new Paginator;

/** display how many domains are in database **/
$domain_total = sql_num_rows("SELECT domain FROM domains");

/** set total number of pages to display **/
$paginate->items_total = $domain_total;

/** set total number of pages to display round to current page number **/
$paginate->mid_range = 7;

/** ammount shown per page **/
$paginate->items_per_page = 12;

/** call pagination method **/
$paginate->paginate();

## Current page ##
$paginate->page_url = $_CONFIG['paths']['base_url'] . '/index.php';

/** display domains from database **/
if($domain_total != 0)
{
    $q = sql_query("SELECT * FROM domains ORDER BY id DESC ".$paginate->limit."");
    while($d = sql_fetch_array($q)){ $domain[] = $d; }
}

/** check for expired domains **/
$domains->check_expired();

/** check for expiring domains **/
$domains->check_expiring();

/** delete domain **/
if(isset($_GET['action']) && $_GET['action'] == 'delete_domain'){ $domains->delete_domain($_GET['id']); } 

/** assign template variables **/
$smarty->assign('domains_total', $domain_total);
$smarty->assign('domains', $domain);
$smarty->assign('paginate', $paginate->display_pages());

/** include footer **/
include("footer.php");

?>
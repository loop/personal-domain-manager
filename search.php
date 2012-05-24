<?php

/** include header **/
include("header.php");

/** set page name **/
$page = 'search';

/** get domain name to search for **/
$search = urldecode($_POST['domain_name']);
$search = preg_replace('#([^a-z0-9\- \.]+)#i', '', mysql_real_escape_string($search));
$search = str_replace(array('http://', 'https://', 'www.'), '', $search);

/** display results from database **/
if(isset($_POST['search']))
{ 
    $q = "SELECT * FROM domains WHERE domain LIKE '%" .$search. "%' ORDER BY id DESC";
	$r = sql_query($q);
	while($d = sql_fetch_array($r)){ $domain[] = $d; } 
	$domain_total = sql_num_rows($q);
}

/** assign template variables **/
$smarty->assign('domains', $domain);
$smarty->assign('domains_total', $domain_total);

/** include footer **/
include("footer.php");

?>
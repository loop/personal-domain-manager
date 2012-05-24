<?php

/** this function selects a row from database **/
function sql_row($query) 
{
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    mysql_free_result($result);
    return $row;
}

/** this function selects a row from database **/
function sql_fetch_array($query) 
{
    $row = mysql_fetch_array($query);
    return $row;
}

/** this function selects num rows from database **/
function sql_num_rows($query) 
{
    $result = mysql_query($query) or die(mysql_error());
    $rows = mysql_num_rows($result);
    mysql_free_result($result);
    return $rows;
}

/** this function performs a mysql query to the database **/
function sql_query($query) 
{
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}


?>
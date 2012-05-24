<?php

/** this function performs a redirection **/
function redirect($url)
{
    if(ereg("Microsoft", $_SERVER['SERVER_SOFTWARE']))
	{
		@header("Refresh: 0; URL=$url");
	}else{
	    @header("Location: $url");
	}
	exit();
}

?>
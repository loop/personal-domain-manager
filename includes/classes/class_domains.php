<?php

class Domains
{

    /** set initial vars **/
	var $is_error = 0;
	var $error_message;
	
    /** this function checks for expired domains **/
	function check_expired($notify = false)
	{
	    /** set globals **/
		global $_CONFIG, $_LANG;
		
		/** build query **/
		$query = "SELECT * FROM domains";
		
		/** run query **/
		$result = sql_query($query);
		
		/** loop over data **/
		while($ex = sql_fetch_array($result))
		{
		    /** todays date **/
			$today = strtotime(date("d-M-y"));
			
			/** expire date **/
			$expire = strtotime($ex['expires']);
			
			/** check domain expire **/
			if($expire <= $today)
			{ 
			    /** update database **/
			    sql_query("UPDATE domains SET status = 'expired' WHERE id = '".$ex['id']."' LIMIT 1");
				
				/** send out expired email **/
				if($notify == true)
				{
				    $message = 'Hi,<br><br>Your domain name: '.$ex['domain'].' expired on: '.$ex['expires'].', please renew or delete this domain from the system to stop receiving these emails.<br><br>Personal Domain Manager';
				    send_generic($_CONFIG['emails']['admin'], 
					             $_CONFIG['emails']['admin'], 
								 $ex['domain'] . ' has expired',
								 $message);
				}
			}		
		}
		
		/** return **/
		return;
	}
	
	    /** this function checks for expiring domains **/
	function check_expiring($notify = false)
	{
	    /** set globals **/
		global $_CONFIG, $_LANG;
		
		/** build query **/
		$query = "SELECT * FROM domains WHERE status != 'expired'";
		
		/** run query **/
		$result = sql_query($query);
		
		/** loop over data **/
		while($ex = sql_fetch_array($result))
		{
		    /** expire date **/
			$expire = strtotime($ex['expires']);
			
			/** expire threshold **/
			$threshold = strtotime(date('d-M-y', strtotime('+'.$_CONFIG['domains']['expire_threshold'].' week')));
			
		    /** check domain expire threshold **/
			if($threshold >= $expire)
			{ 
			    /** update database **/
			    sql_query("UPDATE domains SET status = 'expiring' WHERE id = '".$ex['id']."' LIMIT 1");
				
				/** send out expireing email **/
				if($notify == true)
				{
				    $message = 'Hi,<br><br>Your domain name: '.$ex['domain'].' will expire on: '.$ex['expires'].', Please make sure you renew it asap.<br><br>Personal Domain Manager';
				    send_generic($_CONFIG['emails']['admin'], 
					             $_CONFIG['emails']['admin'], 
								 $ex['domain'] . ' is about to expire', 
								 $message);
				}
			}	
		}
		
		/** return **/
		return;
	}
	
	/** this function deletes a domain **/
	function delete_domain($id)
	{
	    /** set globals **/
		global $_CONFIG, $_LANG;
		
		/** build query **/
		$query = "DELETE FROM domains WHERE id = '".mysql_real_escape_string($id)."' LIMIT 1";
		
		/** run query **/
		sql_query($query);
		
		/** redirect **/
		redirect($_CONFIG['paths']['base_url']);
		
		/** exit **/
		exit;
	}
	
	/** this function adds a domain **/
	function add_domain($domain)
	{
	    /** set globals **/
		global $_CONFIG, $_LANG;
		
		/** remove http ot https from domain **/
	    $domain = str_replace(array('http://', 'https://', 'www.'), '', $domain);
		
		/** include whois class and initiate it **/
	    include('./includes/whois/whois.main.php');
	    $whois = new Whois();
	
	    /** get domains info **/
	    $result = $whois->Lookup($domain);
		
		/** check if domain field is filled **/
		if(empty($_POST['domain']))
		{
		    $this->is_error = 1;
			$this->error_message = 'Please enter a domain name';
		}else
		
		/** check if domain is valid **/
		if($this->validate_exists($domain) == false)
		{
		    $this->is_error = 1;
			$this->error_message = 'Please enter a valid domain name.';
		}else
		
		/** no error **/
		if($this->is_error != 1)
		{
		    /** get registration date **/
	        if(empty($_POST['registered_day']) || empty($_POST['registered_month']) || empty($_POST['registered_year']))
	        {
	            $registered = $result['regrinfo']['domain']['created'];
	        }else{
	            $registered = $_POST['registered_year'] . '-' . $_POST['registered_month'] . '-' . $_POST['registered_day'];
	        }
	
	        /** get expire date **/
	        if(empty($_POST['expires_day']) || empty($_POST['expires_month']) || empty($_POST['expires_year']))
	        {
	            $expire = $result['regrinfo']['domain']['expires'];
	        }else{
	            $expire = $_POST['expires_year'] . '-' . $_POST['expires_month'] . '-' . $_POST['expires_day'];
	        }
		
		    /** create insert array **/
	        $data = array('domain' => mysql_real_escape_string($domain),
	                      'registered' => mysql_real_escape_string($registered),
				          'expire' => mysql_real_escape_string($expire),
				          'status' => 'ok'
				          );
				  
            /** insert data **/
	        sql_query("INSERT INTO domains (domain,
	                                        registered,
									        expires,
									        status
									        ) VALUES (
									        '".$data['domain']."',
									        '".$data['registered']."',
									        '".$data['expire']."',
									        '".$data['status']."'
									        )");
									
            /** check for expired domains **/
            $this->check_expired();

            /** check for expiring domains **/
            $this->check_expiring();
									
            /** redirect **/
	        redirect($_CONFIG['paths']['base_url']);
        }
	}
	
	/** this function validates a domain exists */
	function validate_exists($url) 
	{
	    $resURL = @curl_init();
        @curl_setopt($resURL, CURLOPT_URL, 'http://' . $url);
        @curl_setopt($resURL, CURLOPT_BINARYTRANSFER, 1);
        @curl_setopt($resURL, CURLOPT_HEADERFUNCTION, 'curlHeaderCallback');
        @curl_setopt($resURL, CURLOPT_FAILONERROR, 1);
		@curl_exec ($resURL);
		$intReturnCode = @curl_getinfo($resURL, CURLINFO_HTTP_CODE);
		@curl_close ($resURL);
	    if($intReturnCode != 301 && $intReturnCode != 200 && $intReturnCode != 302 && $intReturnCode != 304){ return false; }else{ return true; }
	}
	
}

?>
<?php
	
if(!function_exists("cast"))
{
	//https://stackoverflow.com/questions/3243900/convert-cast-an-stdclass-object-to-another-class
	function cast($from, $to)
	{
		
	    if (is_string($to))  
	    	$to = new $to();
	    
	    if(is_array($from)) 
	    	$from = (object)$from;
	    
	    //do this after we defintly have 2 objects, rather than performing multiple checks.
	    if(get_class($from) == get_class($to)) return $from;
	    
	    
	    $sourceReflection = new \ReflectionObject($from);
	    $destinationReflection = new \ReflectionObject($to);
	    $sourceProperties = $sourceReflection->getProperties();
	    foreach ($sourceProperties as $sourceProperty) {
	        $sourceProperty->setAccessible(true);
	        $name = $sourceProperty->getName();
	        $value = $sourceProperty->getValue($from);
	        if ($destinationReflection->hasProperty($name)) {
	            $propDest = $destinationReflection->getProperty($name);
	            $propDest->setAccessible(true);
	            $propDest->setValue($to,$value);
	        } else {
	            $to->$name = $value;
	        }
	    }
	    return $to;
	}
}
else
{
	//TODO: log, possible error	
}


if(!function_exists("request_page"))
{
	//https://stackoverflow.com/questions/14953867/how-to-get-page-content-using-curl
	function request_page($url, $options = array() )
	{
	    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
	    
	    $cookieFile = __DIR__ . DIRECTORY_SEPARATOR . "cookies.txt";
		if(!file_exists($cookieFile)) {
		    $fh = fopen($cookieFile, "w");
		    fwrite($fh, "");
		    fclose($fh);
		}
	    
	    $defaultOptions = array(

	        CURLOPT_POST           =>false,        //set to GET
	        CURLOPT_USERAGENT      => $user_agent, //set user agent
	        CURLOPT_COOKIEFILE     => $cookieFile, //set cookie file
	        CURLOPT_COOKIEJAR      => $cookieFile, //set cookie jar
	        //CURLOPT_RETURNTRANSFER => true,     // return web page
	        //CURLOPT_HEADER         => true,    // don't return headers
	        //CURLOPT_FOLLOWLOCATION => true,     // follow redirects
	        //CURLOPT_ENCODING       => "",       // handle all encodings
	        //CURLOPT_CONNECTTIMEOUT => 10,      // timeout on connect
	        //CURLOPT_TIMEOUT        => 10,      // timeout on response
	        //CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	    );
	    
		$options = $options + $defaultOptions;

	    
	    $ch      = curl_init( $url );
	    curl_setopt_array( $ch, $options );
	    $content = curl_exec( $ch );
	    $err     = curl_errno( $ch );
	    $errmsg  = curl_error( $ch );
	    $header  = curl_getinfo( $ch );
	    $cookieList = curl_getinfo($ch, CURLINFO_COOKIELIST);
	    
	    curl_close( $ch );
	    
    	$headOut = null;
    	$bodyOut = $content;
	    if(($defaultOptions[CURLOPT_HEADER] ?? false) == true && strstr($content, "\r\n\r\n"))
	    {
	    	list($headOut, $bodyOut) = explode("\r\n\r\n", $content, 2);
	    }
	    
	    //$header["sent"]    = $options;
	    $header['errno']   = $err;
	    $header['errmsg']  = $errmsg;
	    //$header['cookies']  = $cookieList;
	    $header['header']  = $headOut;
	    $header['content'] = $bodyOut;
	    
	    
	    return $header;
	}
}
else
{
	//TODO: log, possible error	
}

?>
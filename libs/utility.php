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

?>
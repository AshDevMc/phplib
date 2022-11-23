<?php
	
if(!function_exists("ByteString"))
{
	function ByteString($len = 16)
	{

		return openssl_random_pseudo_bytes($len);
	}
}
else
{
	//TODO: log, possible error	
}


if(!function_exists("HexString"))
{
	function HexString($byteString = 8)
	{
		$data = $byteString;

		if(is_int($byteString))
			$data = openssl_random_pseudo_bytes($byteString);

		return rtrim(base64_encode($data), "=");
	}
}
else
{
	//TODO: log, possible error	
}

if(!function_exists("HexToByte"))
{
	function HexToByte($hexString, $len=8)
	{
		$hex = str_pad($hexString, $len, "=");
		return base64_decode($hex);
	}
}
else
{
	//TODO: log, possible error	
}

if(!function_exists("UUID"))
{
	//https://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid
	function UUID($byteString = 16)
	{
		$data = $byteString;

		if(is_int($byteString))
			$data = openssl_random_pseudo_bytes($byteString);

		if(strlen($data) != 16)
			return null;

    	$data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    	$data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    	return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4));
	}
}
else
{
	//TODO: log, possible error	
}




?>
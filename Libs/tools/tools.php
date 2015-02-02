<?php 

class Tools
{
  
	static function language($defaultLang=null)
	{
		if(!isset($defaultLang))
		{
		   $language = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
		   $language = strtolower(substr(chop($language[0]),0,2));
		}
		else
		{
			$language=$defaultLang;	
		}
	return $language;	
	}
	
	
	static function emailvalid($param)
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return $param;
		}
		else
		{
			return $error['email-not-valid'];
		}
	
	}
}

?>
<?php 

Class Caller{

	public static function controller($controller,$method,$arguments = array()){
		$method = !empty($method) ? $method : 'index';

		if(method_exists($controller,$method))			
			return call_user_func_array(array($controller,$method),$arguments);
		else
			throw new Exception("The requested method was not found");			
		
	}
	
}
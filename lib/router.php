<?php 

Class Router{

	private $request_uri;
	private $query_string;	
	private $basename = 'clinica';
	static  $controller_name;
	static  $method_name;
	private $controller;
	static  $arguments = array();

	public function __construct(){
		$this->request_uri  = $_SERVER['REQUEST_URI'];
		$this->query_string = !empty($_SERVER['QUERY_STRING']) ? 
									 $_SERVER['QUERY_STRING']  : null;
	}	

	public function prepare(){
		 $cleared = $this->clear($this->request_uri,$this->query_string);

		 self::$controller_name = $cleared['controller_name'];
		 self::$method_name 	= $cleared['method_name'];
		 self::$arguments 		= $cleared['arguments'];
	}

	public function clear($request_uri,$query_string){

		if(isset($query_string))
			$cleared = substr(join('',explode($query_string,$request_uri)),0,-1);
		else
			$cleared = $request_uri;		

		$basename_out = str_replace($this->basename, '', $cleared);
		$separeted    = array_filter(explode('/',$basename_out),function($var){
			return !empty($var);
		});

		$separeted = array_values($separeted);	
		
		$correct['controller_name'] = isset($separeted[0]) ? $separeted[0] : null;
		$correct['method_name']     = isset($separeted[1]) ? $separeted[1] : null;

		if(isset($separeted[0]))
			unset($separeted[0]);
		if(isset($separeted[1]))
			unset($separeted[1]);

		$correct['arguments'] = array_values($separeted);

		return $correct;
	}	

	public function get_request_uri(){
		return $this->request_uri;
	}

	public function get_query_string(){
		return $this->query_string;
	}
}
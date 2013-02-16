<?php 

Class Controller{

	const DEFAULT_CONTROLLER = 'home';
	protected $name;
	protected $action;
	protected $variables = array();


	/**
	 * Untested Behavior	 
	 */	 
	public function __destruct(){
		extract($this->variables);
		
		include(BASE_PATH.'/views/layout/header.php');
		
		if(!empty($this->name) AND !empty($this->action))
			include(BASE_PATH.'/views/'.$this->name.'/'.$this->action.'.php');

		include(BASE_PATH.'/views/layout/footer.php');
	}
	
	public static function factory($controller_name){
		
		$controller_name = !empty($controller_name) ? 
								  $controller_name  :
						    self::DEFAULT_CONTROLLER;

		$controller_name = ucfirst($controller_name.'Controller');
		return new $controller_name;
	}

	/**
	 * Untested Behavior	 
	 */	 
	public function set_name($name){		
		$this->name = $name;
	}

	/**
	 * Untested Behavior	 
	 */	 
	public function set_action($action){
		$this->action = $action;
	}

	/**
	 * Untested Behavior	 
	 */
	public function input($name,$default=false){
		return !empty($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
	}
}
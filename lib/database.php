<?php 

/**
* Untested Class
*/

class Database{

	public $instance;

	public function __construct(){
		$this->open();
	}

	public function __destruct(){
		$this->instance = null;
	}

	public function open(){
		try {
		   $this->instance = new PDO('mysql:host=localhost;dbname=clinica', 'root', 'root');
		   $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e) {
		    echo 'ERROR: ' . $e->getMessage();
		}		
		return $this->instance;
	}
}
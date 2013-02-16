<?php 

Class RouterTest extends PHPUnit_Framework_TestCase{

	public function setUp(){
		$_SERVER['REQUEST_URI'] = null;
		$_SERVER['QUERY_STRING'] = null;
	}

	public function tearDown(){
		$_SERVER['REQUEST_URI'] = null;
		$_SERVER['QUERY_STRING'] = null;	
	}

	public function testIfRequestUriIsSettedOnConstructor(){

		$_SERVER['REQUEST_URI'] = '/clinica/medicos/';

		$router = new Router;

		$this->assertEquals('/clinica/medicos/', $router->get_request_uri());
	}

	public function testIfQueryStringIsSettedOnConstructor(){		

		$_SERVER['QUERY_STRING'] = 'nome=carlos';

		$router = new Router;

		$this->assertEquals('nome=carlos', $router->get_query_string());	
	}

	public function testIfClearSepareControllerAndmethod(){
		$request_uri  = '/clinica/medicos/buscar?nome=carlos';
		$query_string  = 'nome=carlos';

		$router = new Router;		

		$array = $router->clear($request_uri,$query_string);

		$this->assertEquals(array(
			'controller_name' => 'medicos',
			'method_name' => 'buscar',
			'arguments'=> array()
		), $array);

		$request_uri  = '////clinica/medicos///buscar///?nome=carlos';
		$array = $router->clear($request_uri,$query_string);

		$this->assertEquals(array(
			'controller_name' => 'medicos',
			'method_name' => 'buscar',
			'arguments'=> array()
		), $array);		
	}
	public function testIfClearCanIdentifyWhenHasnomethodGivenOrIfHasnoController(){
		$request_uri  = '/clinica/medicos/?nome=carlos';
		$query_string  = 'nome=carlos';

		$router = new Router;
		$array = $router->clear($request_uri,$query_string);

		$this->assertEquals(array(
			'controller_name' => 'medicos',
			'method_name' => null,
			'arguments'=> array()
		), $array);

		$request_uri = '/clinica/?nome=carlos';
		$array = $router->clear($request_uri,$query_string);
		$this->assertEquals(array(
			'controller_name' => null,
			'method_name' => null,
			'arguments'=> array()
		), $array);

	}

	public function testIfClearCanIdentifyIfHasnoQueryString(){
		$request_uri   = '/clinica/medicos/buscar/';
		$query_string  = null;

		$router = new Router;
		$array = $router->clear($request_uri,$query_string);

		$this->assertEquals(array(
			'controller_name' => 'medicos',
			'method_name' => 'buscar',
			'arguments'=> array()
		), $array);
	}	

	public function testIfPrepareCanSetTheCorrectControllerAndmethod(){
		$_SERVER['REQUEST_URI']  = '/clinica/medicos/buscar?nome=carlos';
		$_SERVER['QUERY_STRING'] = 'nome=carlos';

		$router = new Router;		

		$router->prepare();

		$this->assertEquals('medicos', $router::$controller_name);
		$this->assertEquals('buscar',  $router::$method_name);
	}

	public function testIfClearCanIdentifyTheArguments(){

		$router = new Router;
		$request_uri   = '/clinica/medicos/editar/1/52';
		$array = $router->clear($request_uri,null);

		$this->assertEquals(array('1','52'), $array['arguments']);

		$request_uri  = '/clinica/medicos/editar/1/52?nome=teste';
		$query_string = 'nome=teste';
		$array = $router->clear($request_uri,$query_string);

		$this->assertEquals(array('1','52'), $array['arguments']);
	}

	public function testIfPrepareSetTheParametersCorrectly(){
		$_SERVER['REQUEST_URI']  = '/clinica/medicos/editar/1';	

		$router = new Router;		

		$router->prepare();
		$this->assertEquals(array('1'), $router::$arguments);		
	}	
}
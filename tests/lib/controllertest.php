<?php 

Class ControllerTest extends PHPUnit_Framework_TestCase{

	public function testIfFactoryReturnAnewControllerInstance(){
		$instance = Controller::factory('medicos');
		$this->assertInstanceOf('MedicosController', $instance);
	}

	public function testIfFactoryCreatesAnDefaultControllerWhenTheGivenControllerIsNull(){
		$instance = Controller::factory(null);
		$this->assertInstanceOf('HomeController', $instance);	
	}

	/**
     *@expectedException        Exception
     *@expectedExceptionMessage The requested controller was not found
     */
	/*public function testIfControllerCanThrowAnExceptionIfTheControllerIsnotFound(){
		$mock = $this->getMock('Teste');

		Caller::controller($mock,'index');
	}*/
}
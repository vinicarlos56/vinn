<?php 

Class CallerTest extends PHPUnit_Framework_TestCase{

	public function setUp(){
		
	}

	public function testIfControllerethodCanCallsTheCorrectlyControllerAndmethod(){			

		$mock = $this->mockController();
		$mock->expects($this->once())
					 ->method('buscar');
		
		Caller::controller($mock,'buscar');		
	}

	/**
     * @expectedException        Exception
     * @expectedExceptionMessage The requested method was not found
     */
	public function testIfControllerCanThrowAnExceptionIfThemethodIsnotFound(){
		$mock = $this->mockController();
		$mock->expects($this->never())
					 ->method('false_method');

		Caller::controller($mock,'false_method');
	}

	public function testIfControllerCanPassTheArgumentsCorrectly(){

		$arguments = array('1','teste');

		$mock = $this->mockController();
		$mock->expects($this->once())
					 ->method('editar')
					 ->with($arguments[0],$arguments[1]);

		Caller::controller($mock,'editar',$arguments);
	}

	public function testIfCanCallTheIndexethodIfHasAnNullValueOnMethod(){
		$mock = $this->mockController();
		$mock->expects($this->once())
				->method('index');

		Caller::controller($mock,null);
	}


	public function mockController(){
		return $this->getMock('TestController');
	}

}

class TestController extends Controller{
	public function index(){}
	public function buscar(){}
	public function editar(){}
}


<?php 

Class Consulta{

	protected $db;
	static $horarios = array(
		'14:00:00',
		'15:00:00',
		'16:00:00',
		'17:00:00',
		'18:00:00',
		'19:00:00'
	);
	static $days = array(
		'Sunday'   =>'Domingo',
		'Monday'   =>'Segunda-Feira',
		'Tuesday'  =>'Terça-Feira',
		'Wednesday'=>'Quarta-Feira',
		'Thursday' =>'Quinta-Feira',
		'Friday'   =>'Sexta-Feira',
		'Saturday' =>'Sábado'
	);
	static $months = array(
		'January'  =>'Janeiro',
		'February' =>'Fevereiro',
		'March'    =>'Março',
		'April'	   =>'Abril',
		'May' 	   =>'Maio',
		'June'     =>'Junho',
		'Jully'    =>'Julho',
		'August'   =>'Agosto',
		'September'=>'Setembro',
		'October'  =>'Outubro',
		'November' =>'Novembro',
		'December' =>'Dezembro',
	);

	public function __construct(){
		$this->db = new Database;	
	}

	public function salvar($dados){
		$stmt = $this->db->instance->prepare(
			'INSERT INTO consultas (medico_id,paciente_id,data_consulta) 
			 VALUES(:medico_id,:paciente_id,:data_consulta)'
		);
		return $stmt->execute(
				array(					
					':medico_id'     => $dados['medico_id'],
					':paciente_id'   => $dados['paciente_id'],
					':data_consulta' => $dados['data_consulta']
				)
		);		
	}

	public function list_all(){
		$result = $this->db->instance->query(
			'SELECT c.id,c.data_consulta,m.nome as nome_medico, p.nome as nome_paciente 
			 FROM consultas c JOIN medicos m ON c.medico_id = m.id
			 JOIN pacientes p ON c.paciente_id = p.id'
		);
		$result->setFetchMode(PDO::FETCH_ASSOC); 
		while ($row = $result->fetch()){
			$data[] = $row;
		}

		return $data;
	}

	public function list_all_by_medico_id($medico_id){

		$result = $this->db->instance->prepare(
			'SELECT c.data_consulta,m.nome as nome_medico, p.nome as nome_paciente 
			 FROM consultas c JOIN medicos m ON c.medico_id = m.id
			 JOIN pacientes p ON c.paciente_id = p.id WHERE c.medico_id = :medico_id'
		);
		$result->execute(array(':medico_id'=>$medico_id));
		$result->setFetchMode(PDO::FETCH_ASSOC);
		while ($row = $result->fetch()){
			$data[] = $row;
		}
		return $data;
	}

	public static function format_data($data){
		$separeted = explode('/',$data);
		$new = "{$separeted[2]}-{$separeted[1]}-{$separeted[0]}";
		return $new;
	}

	public static function convert_name($day){		
		return self::$days[$day];
	}
}
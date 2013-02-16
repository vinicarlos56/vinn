<?php 

Class Paciente{
	protected $db;

	public function __construct(){
		$this->db = new Database;	
	}

	public function salvar($nome,$cpf,$telefone,$endereco){
		$stmt = $this->db->instance->prepare(
		'INSERT INTO pacientes (nome,cpf,telefone,endereco) VALUES(:nome,:cpf,:telefone,:endereco)');
		return $stmt->execute(
				array(
					':nome'=>$nome,
					':cpf'=>$cpf,
					':telefone'=>$telefone,
					':endereco'=>$endereco
				)
		);		
	}

	public function list_all(){
		$result = $this->db->instance->query('SELECT * FROM pacientes');
		$result->setFetchMode(PDO::FETCH_ASSOC); 
		while ($row = $result->fetch()){
			$data[] = $row;
		}

		return $data;
	}

	public function get_id_by_name($name){
		
		$result = $this->db->instance->prepare('SELECT id FROM pacientes WHERE nome = :name LIMIT 1');
		$result->execute(array(':name'=>$name));
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();		
		return $row['id'];
	}
	/*
	public function build_select(){
		$result = $this->db->instance->query('SELECT id,nome FROM pacientes');
		$result->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $result->fetch()){
			$data[$row['id']] = $row['nome'];
		}
		return array(''=>'Selecione') + $data;
	}*/
}
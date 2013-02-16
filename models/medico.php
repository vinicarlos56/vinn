<?php 

Class Medico{

	protected $db;

	public function __construct(){
		$this->db = new Database;	
	}

	public function salvar($nome,$crm){
		$stmt = $this->db->instance->prepare('INSERT INTO medicos (nome,crm) VALUES(:nome,:crm)');
		return $stmt->execute(array(':nome'=>$nome,':crm'=>$crm));		
	}

	public function list_all(){
		$result = $this->db->instance->query('SELECT * FROM medicos');
		$result->setFetchMode(PDO::FETCH_ASSOC); 
		while ($row = $result->fetch()){
			$data[] = $row;
		}

		return $data;
	}

	public function build_select(){
		$result = $this->db->instance->query('SELECT id,nome FROM medicos');
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$data = array();
		while ($row = $result->fetch()){
			$data[$row['id']] = $row['nome'];
		}
		return array(''=>'Selecione') + $data;
	}
}
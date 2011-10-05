<?php
require_once('Table.php');
class Recibo extends Table{
	var $masterTable='';
	var $externalIndex = '';
	function __construct() {
		$this->dbtype = 'mysql';
		$this->dbname = 'academia';
		$this->dbhost = 'localhost';
		$this->dbuser = 'root';
		$this->dbpass = 'secreto';
		$this->table = 'recibo';
		$this->masterTable= 'alumno';
		$this->externalIndex= 'alumno_id';
		$this->formTemplate = 'reciboForm.tpl';
		$this->listTemplate = 'reciboList.tpl';
		$this->fields= array(
				'Fecha', 'Asignaturas', 'Importe', 'Pagado'
		);
		parent::__construct();
	}

	//sobreescrita!
	function getNumRecords(){
		return $this->getNumRelatedRecords();
	}


	function isValidForm($formvars) {
		$this->error = null;

		if(strlen($formvars['Asignaturas']) == 0) {
			$this->error = 'Asignaturas_empty';
			return false; 
		}

		if(strlen($formvars['Importe']) == 0) {
			$this->error = 'Importe_empty';
			return false; 
		}

		return true;
	}
	//sobreescrita
	function addEntry($formvars) {        
		try {
			$q = "insert into " . $this->table . " (";
			foreach($this->fields as $field){
				$q.= $field . ',';
			}
			$q.= $this->externalIndex . ',';
			$q=substr($q,0, -1);//quitamos la última coma
			$q .= ') values (';
			foreach($this->fields as $field){
				$q.= '?,';
			}
			$q.= '?,';
			$q=substr($q,0, -1);//quitamos la última coma
			$q .= ')';
			$rh = $this->pdo->prepare($q);
			$v = array();
			foreach($this->fields as $field){
				$v[] = $formvars[$field];
			}
			$v[] = $this->masterId;
			$rh->execute($v);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		}	
		return true;
		}
	//sobreescrita
	function getRecords(){
		$this->fromRec =  $_SESSION['fromRec'];
		try {
			$sql = 'select * from ' . $this->table 
				.' where '. $this->externalIndex . ' = ' 
				.$this->masterId 
				. ' LIMIT ' 
				. $this->fromRec 
				. ','
				.$this->recsByPage;
			$rows = array();
			foreach ($this->pdo->query($sql) as $row) {
				$rows[] = $row;
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		} 	
		return $rows;   
	}
}
?>

<?php
require_once('DetailTable.php');
class Recibo extends DetailTable{
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
}
?>

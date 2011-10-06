<?php
require_once('MasterTable.php');
class Alumno extends MasterTable{
	function __construct() {
		$this->dbtype = 'mysql';
		$this->dbname = 'academia';
		$this->dbhost = 'localhost';
		$this->dbuser = 'root';
		$this->dbpass = 'secreto';
		$this->table = 'alumno';
		$this->formTemplate = 'alumnoForm.tpl';
		$this->listTemplate = 'alumnoList.tpl';
		$this->fields= array(
				'Nombre', 'DNI', 'Telefono', 'Email'
		);
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->error = null;

		if(strlen($formvars['Nombre']) == 0) {
			$this->error = 'Nombre_empty';
			return false; 
		}

		if(strlen($formvars['DNI']) == 0) {
			$this->error = 'DNI_empty';
			return false; 
		}

		return true;
	}
}
?>

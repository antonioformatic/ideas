<?php
require_once(LIB_DIR .'DetailTable.php');
class Participante extends DetailTable{
	function __construct() {
		$this->table        = 'participante';
		$this->listTable    = 'participanteConEquipo';
		$this->masterTable  = 'carrera';
		$this->externalIndex= 'carrera_id';
		$this->formTemplate = 'participanteForm.tpl';
		$this->listTemplate = 'participanteList.tpl';
		$this->fields= array(
				'equipo_id'      
		);
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->error = null;
		return true;
	}
}
?>

<?php
require_once(LIB_DIR .'MasterTable.php');
class CarreraConParticipantes extends MasterTable{
	function __construct() {
		$this->table = 'carreraConParticipantes';
		$this->formTemplate = 'carreraConParticipantesForm.tpl';
		$this->listTemplate = 'carreraConParticipantesList.tpl';
		$this->fields= array(
				'carrera_lugar', 
				'equipo_id', 
				'equipo_nombre'  
		);
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->error = null;
		return true;
	}
}
?>

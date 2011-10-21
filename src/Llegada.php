<?php
require_once(LIB_DIR .'MasterTable.php');
class Calificacion extends MasterTable{
	function __construct() {
		$this->table        = 'calificacion';
		$this->masterTable  = 'carrera';
		$this->formTemplate = 'carreraForm.tpl';
		$this->listTemplate = 'carreraConCalificacionesList.tpl';
		$this->fields= array(
				'fecha', 
				'lugar', 
				'distancia', 
				'mapa' 
		);
		$this->level = 10;
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->errors = null;
		return true;
	}
}
?>

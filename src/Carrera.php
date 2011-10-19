<?php
require_once(LIB_DIR .'MasterTable.php');
class Carrera extends MasterTable{
	function __construct() {
		$this->table        = 'carrera';
		$this->formTemplate = 'carreraForm.tpl';
		$this->listTemplate = 'carreraList.tpl';
		$this->fields= array(
				'fecha', 
				'lugar', 
				'distancia', 
				'mapa' 
		);
		$this->level = 10;
		parent::__construct();
	}
	function getTable(){
		return '{
			"add"      : "true",
			"edit"     : "true",
			"delete"   : "true",
			"colModel" : [
				{"display": "Id",       "name" : "id",       "width" : 40  },
				{"display": "Fecha",   "name" : "fecha",   "width" : 150 },
				{"display": "Lugar","name" : "lugar","width" : 150 },
				{"display": "Distancia", "name" : "distancia", "width" : 250 } 
			]
		}';
	}

	function isValidForm($formvars) {
		$this->error = null;

		/*
		if(strlen($formvars['nombre']) == 0) {
			$this->error = 'nombre_empty';
			return false; 
		}
		*/
		return true;
	}
}
?>

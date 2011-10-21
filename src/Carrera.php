<?php
require_once(LIB_DIR .'MasterTable.php');
class Carrera extends MasterTable{
	function __construct() {
		$this->table        = 'carrera';
		$this->formTemplate = 'carreraForm.tpl';
		$this->listTemplate = 'carreraList.tpl';
		$this->detailView   = 'inscripcion';
		$this->fields= array(
				'nombre', 
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
				{"display": "Id",       "name" : "id",       "width" : 5  },
				{"display": "Nombre",   "name" : "nombre",   "width" : 50 },
				{"display": "Fecha",    "name" : "fecha",    "width" : 25 },
				{"display": "Lugar",    "name" : "lugar",    "width" : 50 },
				{"display": "Distancia","name" : "distancia","width" : 5  }, 
				{"display": "Mapa",     "name" : "mapa",     "width" : 50 } 
			]
		}';
	}
	function getForm(){
		return '{
			"colModel" : [
				{"type":"text", "display": "Nombre",   "value" : "nombre",   "width" : 150 },
				{"type":"date", "display": "Fecha",    "value" : "fecha",    "width" : 250 },
				{"type":"text", "display": "Lugar",    "value" : "lugar",    "width" : 150 },
				{"type":"text", "display": "Distancia","value" : "distancia","width" : 150 },
				{"type":"text", "display": "Mapa",     "value" : "mapa",     "width" : 150 } 
			]
		}';
	}

	function isValidForm($formvars) {
		$this->errors = null;
		return true;
	}
}
?>

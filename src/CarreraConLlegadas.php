<?php
require_once(LIB_DIR .'MasterTable.php');
class CarreraConLlegadas extends MasterTable{
	function __construct() {
		$this->table        = 'carrera';
		$this->detailView   = 'llegada';
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
				{"type":"text", "display": "Id",       "name" : "id",       "width" : 5  },
				{"type":"text", "display": "Nombre",   "name" : "nombre",   "width" : 50 },
				{"type":"text", "display": "Fecha",    "name" : "fecha",    "width" : 25 },
				{"type":"text", "display": "Lugar",    "name" : "lugar",    "width" : 50 },
				{"type":"text", "display": "Distancia","name" : "distancia","width" : 5  }, 
				{"type":"text", "display": "Mapa",     "name" : "mapa",     "width" : 50 } 
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

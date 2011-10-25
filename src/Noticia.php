<?php
require_once(LIB_DIR .'MasterTable.php');
class Noticia extends MasterTable{
	function __construct() {
		$this->table        = 'noticia';
		$this->fields= array(
				'texto', 
				'fecha' 
		);
		$this->level = 0;
		parent::__construct();
	}

	function getTable(){
		return '{
			"add"      : "true",
			"edit"     : "true",
			"delete"   : "true",
			"colModel" : [
				{"type":"textarea", "display": "Texto",      "name" : "texto",   "width" : 50 },
				{"type":"date", "display": "Fecha",      "name" : "fecha",    "width" : 5  } 
			]
		}';
	}
	function getForm(){
		return '{
			"colModel" : [
				{"type":"textarea", "display": "Texto",      "value" : "texto",   "width" : 50 },
				{"type":"date", "display": "Fecha",      "value" : "fecha",    "width" : 5  } 
			]
		}';
	}
	function isValidForm($formvars) {
		$this->errors= null;
		return true;
	}
}
?>

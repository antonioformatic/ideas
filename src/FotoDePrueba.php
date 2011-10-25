<?php
require_once(LIB_DIR .'DetailTable.php');
class FotoDePrueba extends DetailTable{
	function __construct() {
		$this->table        = 'fotosDePrueba';
		$this->listTable    = 'fotosDePrueba';
		$this->masterTable  = 'pruebas';
		$this->masterView   = 'pruebas';
		$this->externalIndex= 'pruebas_id';
		$this->fields= array(
			'image'          
		);
		$this->level = 0;
		parent::__construct();
	}
	function getTable(){
		$ret = '{' ;
		if($_SESSION['nivel_usuario'] > 5){
			$ret .= ' "add"      : "true"';
			$ret .= ',"edit"     : "true"';
			$ret .= ',"delete"   : "true"';
		}else{
			$ret .= ' "add"      : "false"';
			$ret .= ',"edit"     : "false"';
			$ret .= ',"delete"   : "false"';
		}
		$ret .= ',
			"colModel" : [
				{"type":"image","display": "Foto", "name" : "image",     "width" : 250 }
			]
		}';
		return $ret;
	}
	function getForm(){
		return '{
			"colModel" : [
				{
					"type"       :"image"        , 
					"display"    :"Foto"         ,   
					"value"      :"image"       
				},
				{
					"type"       :"masterId"     , 
					"display"    :"Prueba"       ,   
					"value"      :"pruebas_id"       
				}
			]
		}';
	}

	function isValidForm($formvars) {
		$this->errors = null;
		return empty($this->errors);
	}
}
?>

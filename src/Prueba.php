<?php
require_once(LIB_DIR .'MasterTable.php');
class Prueba extends MasterTable{
	function __construct() {
		$this->table        = 'pruebas';
		$this->listTable    = '';
		$this->formTemplate = 'pruebaForm.tpl';
		$this->listTemplate = 'pruebaList.tpl';
		$this->detailView   = 'piloto';
		$this->fields= array(
			'nombre'              ,
			'fecha'               ,
			'pagado'              ,
			'comentario'          ,
			'usuario_id'          ,
			'foto_id'          
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
				{"display": "Id",              "name" : "id",             "width" : 40  },
				{"display": "Nombre",          "name" : "nombre",         "width" : 150 },
				{"display": "Fecha",           "name" : "fecha",          "width" : 150 },
				{"display": "Pagado",          "name" : "pagado",         "width" : 250 },
				{"display": "Comentario",      "name" : "comentario",     "width" : 250 },
				{"display": "Usuario",         "name" : "usuario_id",     "width" : 250 },
				{"display": "Foto",            "name" : "foto",           "width" : 250 }
			]
		}';
		return $ret;
	}
	function getForm(){
		return '{
			"colModel" : [
				{"type":"text", "display": "Nombre",   "value" : "nombre",   "width" : 150 },
				{"type":"date", "display": "Fecha",    "value" : "fecha",    "width" : 250 },
				{
					"type"     : "menu"                              ,
					"display"  : "Pagado"                            ,     
					"value"    : "pagado"                            ,     
					"options"  : ["Si","No"] ,
					"width"    : 25 
				},
				{
					"type"     : "textarea"     , 
					"display"  : "Comentarios"  ,     
					"value"    : "comentario"   ,     
					"width"    : 50             , 
					"height"   : 2 
				},
				{
					"type"       :"lookup"       , 
					"display"    :"Foto"         ,   
					"value"      :"foto_id"      ,
					"width"      : 25            , 
					"id"         :"idDelUsuario" ,
					"database"   :"carrilanas"   ,
					"table"      :"foto"         ,
					"fieldSearch":"nombre,image" ,
					"fieldRet"   :"id"
				} 
			]
		}';
	}

	function isValidForm($formvars) {
		$this->errors = null;
		if(strlen($formvars['nombre']) == 0) {
			$this->errors[] = 'El nombre está vacío';
		}
		if(strlen($formvars['usuario_id']) == 0) {
			$this->errors[] = 'Tiene que seleccionar un usuario';
		}
		return empty($this->errors);
	}
}
?>

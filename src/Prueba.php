<?php
require_once(LIB_DIR .'MasterTable.php');
class Prueba extends MasterTable{
	function __construct() {
		$this->table        = 'pruebas';
		$this->listTable    = 'pruebasView';
		$this->detailView   = 'fotoDePrueba';
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
				{"type":"text", "display": "Id",        "name" : "id",             "width" : 40  },
				{"type":"text", "display": "Nombre",    "name" : "nombre",         "width" : 150 },
				{"type":"text", "display": "Fecha",     "name" : "fecha",          "width" : 150 },
				{"type":"text", "display": "Pagado",    "name" : "pagado",         "width" : 250 },
				{"type":"text", "display": "Comentario","name" : "comentario",     "width" : 250 },
				{"type":"text", "display": "Usuario",   "name" : "usuario_nombre", "width" : 250 },
				{"type":"image","display": "Foto",      "name" : "foto_image",     "width" : 250 }
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
					"display"    :"Usuario"      ,   
					"value"      :"usuario_id"   ,
					"width"      : 25            , 
					"id"         :"idDelUsuario" ,
					"database"   :"carrilanas"   ,
					"table"      :"usuario"      ,
					"fieldSearch":"nombre"       ,
					"fieldRet"   :"id"
				}, 
				{
					"type"       :"lookup"       , 
					"display"    :"Foto"         ,   
					"value"      :"foto_id"      ,
					"width"      : 25            , 
					"id"         :"idFoto"       ,
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

<?php
require_once(LIB_DIR .'DetailTable.php');
class Inscripcion extends DetailTable{
	function __construct() {
		$this->table        = 'inscripcion';
		$this->listTable    = 'inscripcionList';
		$this->masterTable  = 'carrera';
		$this->masterView   = 'carreraConInscripciones';
		$this->externalIndex= 'carrera_id';
		$this->fields= array(
				'equipo_id'    , 
				'categoria_id'  
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
				{"type":"text", "display": "Carrera",    "name" : "carrera_nombre",   "width" : 50 },
				{"type":"text", "display": "Equipo",     "name" : "equipo_nombre",    "width" : 5  }, 
				{"type":"text", "display": "Categoria",  "name" : "categoria_nombre", "width" : 50 } 
			]
		}';
	}
	function getForm(){
		return '{
			"colModel" : [
				{
					"type"       :"masterId"     , 
					"display"    :"Carrera"      ,   
					"value"      :"carrera_id"   
				},
				{
					"type"       :"external"           ,
					"display"    :"Nombre carrera"     ,             
					"database"   :"carrilanas"         ,
					"table"      :"carrera"            ,
					"value_id"   :"carrera_id"         ,
					"fieldRet"   :"nombre"
				},
				{
					"type"       :"lookup"       , 
					"display"    :"Equipo"       ,   
					"value"      :"equipo_id"    ,
					"width"      : 5             , 
					"id"         :"idDelEquipo"  ,
					"database"   :"carrilanas"   ,
					"table"      :"equipo"       ,
					"fieldSearch":"nombre"       ,
					"fieldRet"   :"id"
				},
				{
					"type"       :"external"           ,
					"display"    :"Nombre del usuario" ,             
					"database"   :"carrilanas"         ,
					"table"      :"equipo"             ,
					"value_id"   :"equipo_id"          ,
					"fieldRet"   :"nombre"
				},
				{
					"type"       :"lookup"       , 
					"display"    :"Categoría"    ,   
					"value"      :"categoria_id" ,
					"width"      : 5             , 
					"id"         :"categoria_id" ,
					"database"   :"carrilanas"   ,
					"table"      :"categoria"    ,
					"fieldSearch":"nombre"       ,
					"fieldRet"   :"id"
				},
				{
					"type"       :"external"           ,
					"display"    :"Nombre del usuario" ,             
					"database"   :"carrilanas"         ,
					"table"      :"categoria"            ,
					"value_id"   :"categoria_id"         ,
					"fieldRet"   :"nombre"
				}
			]
		}';
	}

	function isValidForm($formvars) {
		$this->errors = null;
		return true;
	}
}
?>

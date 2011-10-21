<?php
require_once(LIB_DIR .'MasterTable.php');
class Inscripcion extends MasterTable{
	function __construct() {
		$this->table        = 'inscripcion';
		$this->listTable    = 'inscripcionList';
		$this->formTemplate = 'inscripcionForm.tpl';
		$this->listTemplate = 'inscripcionList.tpl';
		$this->fields= array(
				'carrera_id'   , 
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
				{"display": "Carrera",    "name" : "carrera_nombre",   "width" : 50 },
				{"display": "Equipo",     "name" : "equipo_nombre",    "width" : 5  }, 
				{"display": "Categoria",  "name" : "categoria_nombre", "width" : 50 } 
			]
		}';
	}
	function getForm(){
		return '{
			"colModel" : [
				{
					"type"       :"lookup"       , 
					"display"    :"Carrera"      ,   
					"value"      :"carrera_id"   ,
					"width"      : 5             , 
					"id"         :"carrera_id" ,
					"database"   :"carrilanas"   ,
					"table"      :"carrera"      ,
					"fieldSearch":"nombre,lugar,fecha",
					"fieldRet"   :"id"
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

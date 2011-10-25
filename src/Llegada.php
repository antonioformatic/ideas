<?php
require_once(LIB_DIR .'DetailTable.php');
class Llegada extends DetailTable{
	function __construct() {
		$this->table        = 'llegada';
		$this->listTable    = 'llegadaList';
		$this->masterTable  = 'carrera';
		$this->masterView   = 'carreraConLlegadas';
		$this->externalIndex= 'carrera_id';
		$this->fields= array(
				'tiempo', 
				'puesto', 
				'inscripcion_id' 
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
				{"type":"text", "display": "Tiempo",    "name" : "tiempo",           "width" : 50 },
				{"type":"text", "display": "Puesto",    "name" : "puesto",           "width" : 5  }, 
				{"type":"text", "display": "Categoria", "name" : "categoria_nombre", "width" : 50 },
				{"type":"text", "display": "Equipo",    "name" : "equipo_nombre",    "width" : 50 } 
			]
		}';
	}
	function getForm(){
		return '{
			"colModel" : [
				{
					"type"       :"text"      , 
					"display"    :"Tiempo"    ,   
					"value"      :"tiempo"   
				},
				{
					"type"       :"text"     , 
					"display"    :"Puesto"   ,   
					"value"      :"puesto"   
				},
				{
					"type"       :"masterId"     , 
					"display"    :"Carrera"      ,   
					"value"      :"carrera_id"   
				},
				{
					"type"       :"lookup"                           , 
					"display"    :"Inscripcion"                      ,   
					"value"      :"inscripcion_id"                   ,
					"width"      : 5                                 ,
					"id"         :"idDeLaInscripcion"                ,
					"database"   :"carrilanas"                       ,
					"table"      :"inscripcionList"                  ,
					"filterField":"carrera_id"                       ,
					"filterValue":"masterId"                         ,
					"fieldSearch":"categoria_nombre,equipo_nombre"   ,
					"fieldRet"   :"id"
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

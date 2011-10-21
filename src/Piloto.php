<?php
require_once(LIB_DIR .'MasterTable.php');
class Piloto extends MasterTable{
	function __construct() {
		$this->table        = 'piloto';
		$this->listTable    = 'pilotoConEquipo';
		$this->formTemplate = 'pilotoForm.tpl';
		$this->listTemplate = 'pilotoList.tpl';
		$this->fields= array(
			'nombre'              ,
			'direccion'           ,
			'telefono'            ,
			'email'               ,
			'fecha_de_nacimiento' ,
			'foto'                ,
			'equipo_id'           
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
				{"display": "Nombre",   "name" : "nombre",   "width" : 150 },
				{"display": "Dirección","name" : "direccion","width" : 150 },
				{"display": "Teléfono", "name" : "telefono", "width" : 250 },
				{"display": "Email",    "name" : "email",    "width" : 250 },
				{"display": "Fecha nac","name" : "fecha_de_nacimiento", "width" : 250 },
				{"display": "Foto",     "name" : "foto",     "width" : 250 },
				{"display": "Equipo",   "name" : "equipo_nombre","width" : 250 }
			]
		}';
	}
	function getForm(){
		return '{
			"colModel" : [
				{"type":"text", "display": "Id",       "value" : "id",       "width" : 40  },
				{"type":"text", "display": "Nombre",   "value" : "nombre",   "width" : 150 },
				{"type":"text", "display": "Dirección","value" : "direccion","width" : 150 },
				{"type":"text", "display": "Teléfono", "value" : "telefono", "width" : 250 },
				{"type":"text", "display": "Email",    "value" : "email",    "width" : 250 },
				{"type":"date", "display": "Fecha de nacimiento","value" : "fecha_de_nacimiento", "width" : 250 },
				{"type":"file", "display": "Foto",     "value" : "foto",     "width" : 250 },
				{
					"type"     : "textarea"     , 
					"display"  : "Comentarios"  ,     
					"value"    : "foto"         ,     
					"width"    : 50             , 
					"height"   : 5 
				},
				{
					"type"     : "menu"                ,
					"display"  : "Estado civil"        ,     
					"options"  : ["soltero", "casado", "divorciado"] ,
					"value"    : "foto"                ,     
					"width"    : 250 
				},
				{
					"type"       :"lookup"      , 
					"display"    :"Equipo"      ,   
					"value"      :"equipo_id"   ,
					"width"      : 5            , 
					"id"         :"idDelEquipo" ,
					"database"   :"carrilanas"  ,
					"table"      :"equipo"      ,
					"fieldSearch":"nombre"      ,
					"fieldRet"   :"id"
				},
				{
					"type"       :"external"      ,
					"display"    :"Nombre del equipo"  ,             
					"value"      :"equipo_id"          ,
					"database"   :"carrilanas"         ,
					"table"      :"equipo"             ,
					"value_id"   :"equipo_id"          ,
					"fieldRet"   :"nombre"
				}
			]
		}';
	}

	function isValidForm($formvars) {
		$this->errors= null;
		return true;
	}
}
?>

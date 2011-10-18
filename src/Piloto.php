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

	function isValidForm($formvars) {
		$this->error = null;

		return true;
	}
}
?>

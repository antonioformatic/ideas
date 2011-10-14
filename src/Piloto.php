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

	function isValidForm($formvars) {
		$this->error = null;

		return true;
	}
}
?>

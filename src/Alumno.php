<?php
require_once(LIB_DIR .'MasterTable.php');
class Alumno extends MasterTable{
	function __construct() {
		$this->table        = 'alumno';
		$this->formTemplate = 'alumnoForm.tpl';
		$this->listTemplate = 'alumnoList.tpl';
		$this->fields= array(
				'nombre', 
				'apellidos', 
				'dni', 
				'telefono', 
				'email'
		);
		$this->level = 10;
		parent::__construct();
	}
	function dispatch($controller){
		if(isset($_REQUEST['action'])){
			$this->action= $_REQUEST['action']; 
		}
		switch($this->action) {
		case 'movidas':
			$controller->assign('nombre',"Michel Jackson"); 
			$controller->display('imprimir.tpl');        
			break;
		default:
			parent::dispatch($controller);
			break;
		}
	}

	function isValidForm($formvars) {
		$this->error = null;

		if(strlen($formvars['nombre']) == 0) {
			$this->error = 'nombre_empty';
			return false; 
		}
		if(strlen($formvars['apellidos']) == 0) {
			$this->error = 'apellidos_empty';
			return false; 
		}

		if(strlen($formvars['dni']) == 0) {
			$this->error = 'dni_empty';
			return false; 
		}
		if(strlen($formvars['telefono']) == 0) {
			$this->error = 'telefono_empty';
			return false; 
		}
		return true;
	}
}
?>

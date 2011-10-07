<?php
require_once(LIB_DIR .'MasterTable.php');
class Alumno extends MasterTable{
	function __construct() {
		$this->table        = 'alumno';
		$this->formTemplate = 'alumnoForm.tpl';
		$this->listTemplate = 'alumnoList.tpl';
		$this->fields= array(
				'Nombre', 
				'DNI', 
				'Telefono', 
				'Email'
		);
		$this->level = 10;
		parent::__construct();
	}
	function dispatch($controller){
		if(isset($_REQUEST['action'])){
			$this->action= $_REQUEST['action']; 
		}
		switch($this->action) {
		case 'imprimir':
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

		if(strlen($formvars['Nombre']) == 0) {
			$this->error = 'Nombre_empty';
			return false; 
		}

		if(strlen($formvars['DNI']) == 0) {
			$this->error = 'DNI_empty';
			return false; 
		}
		return true;
	}
}
?>

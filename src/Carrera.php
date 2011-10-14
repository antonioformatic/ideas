<?php
require_once(LIB_DIR .'MasterTable.php');
class Carrera extends MasterTable{
	function __construct() {
		$this->table        = 'carrera';
		$this->formTemplate = 'carreraForm.tpl';
		$this->listTemplate = 'carreraList.tpl';
		$this->fields= array(
				'fecha', 
				'lugar', 
				'distancia', 
				'mapa' 
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

		/*
		if(strlen($formvars['nombre']) == 0) {
			$this->error = 'nombre_empty';
			return false; 
		}
		*/
		return true;
	}
}
?>

<?php
require_once(LIB_DIR .'Table.php');
class Usuario extends Table{
	function __construct() {
		$this->table = 'usuario';
		$this->formTemplate = 'usuarioForm.tpl';
		$this->listTemplate = 'usuarioList.tpl';
		$this->fields= array(
				'nombre', 
				'password',
				'nivel' 
				);
		$this->level = 10;
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->error = null;

		if(strlen($formvars['nombre']) == 0) {
			$this->error = 'nombre_empty';
			return false; 
		}

		if(strlen($formvars['password']) == 0) {
			$this->error = 'password_empty';
			return false; 
		}

		if(strlen($formvars['nivel']) == 0) {
			$this->error = 'nivel_empty';
			return false; 
		}
		return true;
	}
}
?>

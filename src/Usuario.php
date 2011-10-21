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
		$this->errors = null;
		if(strlen($formvars['nombre']) == 0) {
			$this->errors[] = 'El nombre de usuario está vacío';
		}
		if(strlen($formvars['password']) == 0) {
			$this->errors[] = 'La clave está vacía';
		}
		if(strlen($formvars['nivel']) == 0) {
			$this->errors[] = 'El nivel del usuario está vacío';
		}
		return empty($this->errors);
	}
}
?>

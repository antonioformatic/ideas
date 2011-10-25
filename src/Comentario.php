<?php
require_once(LIB_DIR .'DetailTable.php');
class Comentario extends DetailTable{
	function __construct() {
		$this->table = 'comentario';
		$this->masterTable  = 'noticia';
		$this->masterView   = 'noticia';
		$this->externalIndex= 'noticia_id';
		$this->fields= array(
				'texto',
				'usuario_id'
		);
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->errors = null;
		return true;
	}
}
?>

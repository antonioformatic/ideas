<?php
require_once(LIB_DIR .'DetailTable.php');
class Comentario extends DetailTable{
	function __construct() {
		$this->table = 'comentario';
		$this->masterTable= 'noticia';
		$this->externalIndex= 'noticia_id';
		$this->formTemplate = 'comentarioForm.tpl';
		$this->listTemplate = 'comentarioList.tpl';
		$this->fields= array(
				'texto'
		);
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->error = null;
		return true;
	}
}
?>

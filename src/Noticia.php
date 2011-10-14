<?php
require_once(LIB_DIR .'MasterTable.php');
class Noticia extends MasterTable{
	function __construct() {
		$this->table        = 'noticia';
		$this->formTemplate = 'noticiaForm.tpl';
		$this->listTemplate = 'noticiaList.tpl';
		$this->fields= array(
				'texto', 
				'fecha' 
		);
		$this->level = 0;
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->error = null;

		return true;
	}
}
?>

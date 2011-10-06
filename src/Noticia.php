<?php
require_once(LIB_DIR .'Table.php');
class Noticia extends Table{
	function __construct() {
		$this->dbtype = 'mysql';
		$this->dbname = 'academia';
		$this->dbhost = 'localhost';
		$this->dbuser = 'root';
		$this->dbpass = 'secreto';
		$this->table = 'noticia';
		$this->formTemplate = 'noticiaForm.tpl';
		$this->listTemplate = 'noticiaList.tpl';
		$this->fields= array(
				'titulo', 'texto'
		);
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->error = null;

		if(strlen($formvars['titulo']) == 0) {
			$this->error = 'titulo_empty';
			return false; 
		}

		if(strlen($formvars['texto']) == 0) {
			$this->error = 'texto_empty';
			return false; 
		}

		return true;
	}
}
?>

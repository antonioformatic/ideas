<?php
require_once('Table.php');
class Comentario extends Table{
	var $masterTable='';
	var $externalIndex = '';
	function __construct() {
		$this->dbtype = 'mysql';
		$this->dbname = 'academia';
		$this->dbhost = 'localhost';
		$this->dbuser = 'root';
		$this->dbpass = 'secreto';
		$this->table = 'noticia';
		$this->masterTable= '';
		$this->externalIndex= '';
		$this->formTemplate = 'noticiaForm.tpl';
		$this->listTemplate = 'noticiaList.tpl';
		$this->fields= array(
				'titulo', 'texto'
		);
		parent::__construct();
	}

	//sobreescrita!
	function getNumRecords(){
		return $this->getNumRelatedRecords();
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

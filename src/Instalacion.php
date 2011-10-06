<?php
require_once(LIB_DIR .'Table.php');
class Instalacion extends Table{
	function __construct() {
		$this->dbtype = 'mysql';
		$this->dbname = 'academia';
		$this->dbhost = 'localhost';
		$this->dbuser = 'root';
		$this->dbpass = 'secreto';
		$this->table = 'instalacion';
		$this->formTemplate = 'instalacionForm.tpl';
		$this->listTemplate = 'instalacionList.tpl';
		$this->fields= array(
				'nombre', 'actividades'
		);
		$this->templateData['instalacionForm.tpl'] = array(
			'posiblesActividades' => array(
				'cine',
				'teatro',
				'video'
			)
		);
		$this->templateData['instalacionList.tpl'] = array(
			'posiblesActividades' => array(
				'cine',
				'teatro',
				'video'
			)
		);
		parent::__construct();
	}

	function isValidForm($formvars) {
		return true;
		/*
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
	*/
	}
}
?>

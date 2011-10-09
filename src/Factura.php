<?php
require_once(LIB_DIR .'DetailTable.php');
class Factura extends DetailTable{
	function __construct() {
		$this->table = 'factura';
		$this->masterTable= 'alumno';
		$this->externalIndex= 'alumno_id';
		$this->formTemplate = 'facturaForm.tpl';
		$this->listTemplate = 'facturaList.tpl';
		$this->fields= array(
				'importe'     , 
				'concepto'    , 
				'fecha'       , 
				'fecha_pago'  
		);
		parent::__construct();
	}

	function isValidForm($formvars) {
		$this->error = null;

		if(strlen($formvars['importe']) == 0) {
			$this->error = 'importe_empty';
			return false; 
		}

		if(strlen($formvars['concepto']) == 0) {
			$this->error = 'concepto_empty';
			return false; 
		}
		if(strlen($formvars['fecha']) == 0) {
			$this->error = 'fecha_empty';
			return false; 
		}

		return true;
	}
}
?>

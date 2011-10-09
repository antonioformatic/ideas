<?php
require_once(LIB_DIR .'MasterTable.php');
class FacturaConAlumno extends MasterTable{
	function __construct() {
		$this->table = 'facturaConAlumno';
		$this->formTemplate = 'facturaConAlumnoForm.tpl';
		$this->listTemplate = 'facturaConAlumnoList.tpl';
		$this->fields= array(
				'importe'     , 
				'concepto'    , 
				'fecha'       , 
				'fecha_pago'  , 
				'alumno_id'   , 
				'nombre'      , 
				'apellidos'   , 
				'dni'         , 
				'email'  
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

<?php
require(LIB_DIR . 'BasicController.php');
require(SRC_DIR . 'Alumno.php');
require(SRC_DIR . 'Factura.php');
require(SRC_DIR . 'FacturaConAlumno.php');
require(SRC_DIR . 'Usuario.php');
require(SRC_DIR . 'Logger.php');
require(SRC_DIR . 'Inicio.php');
require(SRC_DIR . 'Rechazo.php');
class Controller extends BasicController{
	function __construct() {
		parent::__construct();
		$this->assign('opciones', array(
			'Inicio'=>'inicio',
			'Alumnos'=>'alumno',
			'Facturas'=>'facturaConAlumno',
			'Usuarios'=>'usuario',
			'Login'=>'login',
			'Logout'=>'logout'
		));
	}
	function dispatch(){
		if(isset($_SESSION['view'])){
			$this->view = $_SESSION['view'];	
		}
		if(isset($_REQUEST['view'])){
			$this->view= $_REQUEST['view']; 
			$_SESSION['view'] = $this->view;
			//decide cambiar o no de vista, segun permisos
		}
		switch($this->view){
		case 'alumno':
			$object = new Alumno;
			break;
		case 'factura':
			$object = new Factura; 
			break;
		case 'facturaConAlumno':
			$object = new FacturaConAlumno; 
			break;
		case 'usuario':
			$object = new Usuario; 
			break;
		case 'login':
			$object = new Logger; 
			if($object->login($this)){
				$object = new Inicio; 
			}
			break;
		case 'logout':
			$object = new Logger; 
			$object->logout();
			$object = new Inicio; 
			break;
		case 'inicio':
		default:
			$object = new Inicio; 
			break;
		}
		if(!isset($_SESSION['nivel'])){
			$_SESSION['nivel']=0;
		}
		if($object->getLevel() > $_SESSION['nivel']){
			$object = new Rechazo; 
			$this->assign('nivel_usuario',  0); 
		}else{
			$this->assign('id_usuario',     $_SESSION['id']); 
			$this->assign('nombre_usuario', $_SESSION['nombre']); 
			$this->assign('nivel_usuario',  $_SESSION['nivel']); 
		}
		$object->dispatch($this);
	}
}
?>

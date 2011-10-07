<?php
require(LIB_DIR . 'BasicController.php');
require(SRC_DIR . 'Alumno.php');
require(SRC_DIR . 'Recibo.php');
require(SRC_DIR . 'Noticia.php');
require(SRC_DIR . 'Menu.php');
require(SRC_DIR . 'Instalacion.php');
class Controller extends BasicController{
	function __construct() {
		parent::__construct();
		$this->assign('opciones', array(
			'Alumnos'=>'alumno',
			'Noticias'=>'noticia',
			'Instalaciones'=>'instalacion',
			'Menu'=>'menu'
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
		case 'recibo':
			$object = new Recibo; 
			break;
		case 'noticia':
			$object = new Noticia; 
			break;
		case 'instalacion':
			$object = new Instalacion; 
			break;
		default:
			$object = new Menu; 
			break;
		}
		$object->dispatch($this);
	}
}
?>

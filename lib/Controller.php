<?php
require(LIB_DIR . 'Alumno.php');
require(LIB_DIR . 'Recibo.php');
require(LIB_DIR . 'Noticia.php');
require(LIB_DIR . 'Menu.php');
class Controller extends Smarty{
	var $action= null; 
	var $view= null; 
	function __construct() {
		parent::__construct();
		$this->template_dir = 'templates';
		$this->compile_dir  = 'templates_c';
		$this->config_dir   = 'configs';
		$this->cache_dir    = 'cache';
		session_start();
		$this->assign('opciones', array(
			'Alumnos'=>'alumno',
			'Noticias'=>'noticia'
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
		default:
			$object = new Menu; 
			break;
		}
		$object->dispatch($this);
	}
}
?>

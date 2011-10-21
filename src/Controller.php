<?php
require(LIB_DIR . 'BasicController.php');

require(SRC_DIR . 'Prueba.php');

require(SRC_DIR . 'Carrera.php');
require(SRC_DIR . 'Noticia.php');
require(SRC_DIR . 'Comentario.php');
require(SRC_DIR . 'Inscripcion.php');
require(SRC_DIR . 'CarreraConLlegadas.php');
require(SRC_DIR . 'CarreraConInscripciones.php');
require(SRC_DIR . 'Usuario.php');
require(SRC_DIR . 'Logger.php');
require(SRC_DIR . 'Inicio.php');
require(SRC_DIR . 'Rechazo.php');
require(SRC_DIR . 'Piloto.php');
class Controller extends BasicController{
	function __construct() {
		parent::__construct();
		$this->assign('opciones', array(
			'Inicio'          => 'inicio',
			'Carreras'        => 'carrera',
			'Pilotos'         => 'piloto',
			'Pruebas'         => 'prueba',
			'Inscripciones'   => 'inscripcion',
			'Clasificaciones' => 'carreraConLlegadas',
			'Foro'            => 'noticia',
			'Usuarios'        => 'usuario',
			'Login'           => 'login',
			'Logout'          => 'logout'
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
		case 'usuario':
			$object = new Usuario; 
			break;
		case 'carrera':
			$object = new Carrera; 
			break;
		case 'inscripcion':
			$object = new Inscripcion; 
			break;
		case 'prueba':
			$object = new Prueba; 
			break;
		case 'carreraConInscripciones':
			$object = new CarreraConInscripciones; 
			break;
		case 'carreraConLlegadas':
			$object = new CarreraConLlegadas; 
			break;
		case 'noticia':
			$object = new Noticia; 
			break;
		case 'piloto':
			$object = new Piloto; 
			break;
		case 'comentario':
			$object = new Comentario; 
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
		if(!isset($_SESSION['nivel_usuario'])){
			$_SESSION['nivel_usuario']=0;
			$_SESSION['nombre_usuario']='';
			$_SESSION['id_usuario']=0;
		}
		if($object->getLevel() > $_SESSION['nivel_usuario']){
			$object = new Rechazo; 
			$this->assign('nivel_usuario',  0); 
		}else{
			$this->assign('id_usuario',     $_SESSION['id_usuario']); 
			$this->assign('nombre_usuario', $_SESSION['nombre_usuario']); 
			$this->assign('nivel_usuario',  $_SESSION['nivel_usuario']); 
		}
		$object->dispatch($this);
	}
}
?>

<?php
require_once(LIB_DIR .'Table.php');
class Logger extends Table{
	var $userData=null;
	function __construct() {
		$this->table = 'usuario';
		$this->formTemplate = 'loginForm.tpl';
		$this->listTemplate = '';
		$this->fields= array(
				'nombre', 
				'password',
				'nivel' 
				);
		$this->level = 0;
		parent::__construct();
	}
	function dispatch($controller){
		$controller->display("login.tpl");        
	}
	function login($controller){
		if(isset($_POST['nombre']) && isset($_POST['password'])){
			$user = $this->getUser($_POST['nombre'],$_POST['password']);
			if(!empty($user)){
				$_SESSION['id']    =$user['id'];
				$_SESSION['nombre']=$user['nombre'];
				$_SESSION['nivel'] =$user['nivel'];
				return true;	
			}
		}
		return false;
	}
	function logout(){
		$_SESSION['id'] = 0;
		$_SESSION['nombre'] = '';
		$_SESSION['nivel'] = 0;
	}

	function isValidForm($formvars) {
		$this->error = null;

		if(strlen($formvars['nombre']) == 0) {
			$this->error = 'nombre_empty';
			return false; 
		}

		if(strlen($formvars['password']) == 0) {
			$this->error = 'password_empty';
			return false; 
		}

		if(strlen($formvars['nivel']) == 0) {
			$this->error = 'nivel_empty';
			return false; 
		}
		return true;
	}
	function getUser($nombre, $password){
		try {
			$sql ='select * from ' .$this->table." where nombre = ? and password = ?";
			$rh = $this->pdo->prepare($sql); 
			$rh->execute(array($nombre, $password));
			$row = $rh->fetch(PDO::FETCH_BOTH);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		} 	
		return $row;   
	}
}
?>

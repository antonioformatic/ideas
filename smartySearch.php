<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
define('SMARTY_DIR', 'smarty/');
define('LIB_DIR',    'lib/');
require(SMARTY_DIR . 'Smarty.class.php');
class Buscador{
	var $pdo = null;
	var $tpl = null;
	var $error = null;
	var $smarty = null;

	var $dbtype = 'mysql';
	var $dbname = 'academia';
	var $dbhost = 'localhost';
	var $dbuser = 'root';
	var $dbpass = 'secreto';
	var $table = 'alumno';
	function __construct(){
		try {
			$dsn = "{$this->dbtype}:host={$this->dbhost};dbname={$this->dbname}";
			$this->pdo =  new PDO($dsn,$this->dbuser,$this->dbpass);
		} catch (PDOException $e) {
			print "Error de conexion!: " . $e->getMessage();
			die();
		}	
	}
	function getRecords($sql){
		try {
			$rows = array();
			foreach ($this->pdo->query($sql) as $row => $data) {
				$rows[] = $data;
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		} 	
		return $rows;   
	}
	function buscar(){
		$sql = 'select Nombre , id from alumno';
		$this->smarty = new Smarty;
		$s = $this->getRecords($sql);
		$this->smarty->assign('alumnos',$this->getRecords($sql));
		$this->smarty->display('smartySearch.tpl');
	}
}
$b= new Buscador;
$b->buscar();
?>


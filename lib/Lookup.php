<?php
/*
Busca en una tabla una id dada y devuelve el valor 
de un campo dado.
Parametros:
	database: base de datos donde buscar
	table   : tabla donde buscar
	fieldRet: campo a devolver
	id      : id a localizar
*/
require_once("Funciones.php");
define('SRC_DIR',    '../src/');
require(SRC_DIR    . 'Config.php');

global $dbtype;
global $dbname;
global $dbhost;
global $dbuser;
global $dbpass;

$connection = mysql_pconnect($dbhost, $dbuser, $dbpass) 
	or trigger_error(mysql_error(),E_USER_ERROR); 

$database= $_GET['database'];
$table   = $_GET['table'];
$fieldRet= $_GET['fieldRet'];
$id      = $_GET['value_id'];
if(!$id){
	echo "";
	return;
}
mysql_select_db($database, $connection);
$query_conexion = "SELECT * FROM ". $table . "  WHERE id = ". $id; 
$conexion = mysql_query($query_conexion, $connection) or die(mysql_error());
$row = mysql_fetch_assoc($conexion);
if($row){
	echo $row[$fieldRet];
}else{
	echo "";
}
mysql_free_result($conexion);
?>

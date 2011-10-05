<?php
//error_reporting(E_ALL);
//ini_set('display_errors','On');
define('SMARTY_DIR', 'smarty/');
define('LIB_DIR',    'lib/');
require(SMARTY_DIR . 'Smarty.class.php');
require(LIB_DIR    . 'Controller.php');
$controller= new Controller;
$controller->dispatch();
?>

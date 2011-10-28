<?php
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_HttpClient');
Zend_Loader::loadClass('Zend_Gdata_Calendar');
Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_Photos_UserQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_PhotoQuery');
Zend_Loader::loadClass('Zend_Gdata_App_Extension_Category');
require_once(LIB_DIR .'MasterTable.php');
class Calendario extends MasterTable{
	function __construct() {
		$this->level = 10;
		parent::__construct();
	}
	function dispatch($controller){
		if(isset($_REQUEST['action'])){
			$this->action= $_REQUEST['action']; 
		}
		$this->tpl = $controller;
		$this->tpl->display('calendario.tpl');
	}
	function getLevel(){
		return $this->level;
	}
}
?>

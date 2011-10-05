<?php
class Profesor{
	var $template= 'profesorMenu.tpl';
	function dispatch($controller){
		if(isset($_REQUEST['action'])){
			$action= $_REQUEST['action'];
			switch($action){
			case 'open':
				$controller->assign('name', "Luis Alfonso");
				$this->template = 'profesorOpening.tpl';
				break;
			case 'close':
				$controller->assign('name', "Luis Alfonso");
				$this->template = 'profesorClosing.tpl';
				break;
			}
		}
		$controller->display($this->template);        
	}
}
?>

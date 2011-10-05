<?php
class Alumno {
	var $template = 'alumnoMenu.tpl';
	function dispatch($controller){
		if(isset($_REQUEST['action'])){
			$action= $_REQUEST['action']; 
			switch($action){
			case 'open':
				$controller->assign('name', "Jose Carlos");
				$this->template = 'alumnoOpening.tpl';
				break;
			case 'close':
				$controller->assign('name', "Jose Carlos");
				$this->template = 'alumnoClosing.tpl';
				break;
			}
		}
		$controller->display($this->template);        
	}
}
?>

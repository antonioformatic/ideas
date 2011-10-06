<?php
class Menu{
	var $template = 'menu.tpl';
	function dispatch($controller){
		$controller->display($this->template);        
	}
}
?>

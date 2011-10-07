<?php
class Instalacion{
	var $nombre;
	var $size;
	function incrementar(){
		$this->size += 1;
	}

}
class Aula extends Instalacion{
	var $profesor;
}

function saludo(){
	echo "hola";
}

$a = new Instalacion;
$b = new Instalacion;
$a->nombre = "Gimnasio";
$b->nombre = "Teatro";
$a->size= 10; 
$b->size= 30; 
$a->incrementar();

$c = new Aula;
$c->incrementar();
$c->profesor = "Toño";

?>

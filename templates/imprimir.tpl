{* Smarty *}
{include file="header.tpl"}
{include file="menu.tpl"}
<h1>En esta página ponemos un formulario para imprimir, por ejemplo.</h1>
<td><a href="{$SCRIPT_NAME}?action=close&view=inicio"  >
	<button>Volver al inicio, por ejemplo</button>
</a>
<p>
<td><a href="{$SCRIPT_NAME}?action=edit&view=alumno"  >
	<button>Volver al alumno, por ejemplo</button>
</a>
<form onsubmit="addEvent()>
	Titulo: <input name="title" />
	Desde: <input name="desde" />
	Hasta: <input name="hasta" />
	<input type="submit" value="Crear evento" />
</form>
<SCRIPT TYPE="text/javascript">
function TestDataCheck() {
	var nombre= parseInt(document.testform.nombre.value);
	var desde= parseInt(document.testform.desde.value);
	var hasta= parseInt(document.testform.hasta.value);
	addEvent(nombre, desde, hasta);
}
// -->
</SCRIPT>

<FORM 
   ACTION=""
   NAME="testform" 
   onSubmit="return TestDataCheck()" 
   >
Nombre: <INPUT NAME="nombre" SIZE=3><BR>
Desde: <INPUT NAME="desde" SIZE=3><BR>
Hasta: <INPUT NAME="hasta" SIZE=3><P>
<INPUT TYPE=SUBMIT VALUE="Submit">
</FORM>
{include file="footer.tpl"}

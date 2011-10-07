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
{include file="footer.tpl"}

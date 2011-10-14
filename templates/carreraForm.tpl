{* Smarty *}
{include file="header.tpl"}
{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
  <table border="0">
    {if $error ne ""}
      <tr>
      <td bgcolor="yellow" colspan="2">
      {if $error eq "nombre_empty"}
	  	Se necesita un nombre
      {elseif $error eq "apellidos_empty"}
	  	Los apellidos no pueden estar vacíos 
      {elseif $error eq "dni_empty"}
	  	El DNI no puede estar vacío 
      {elseif $error eq "telefono_empty"}
	  	El teléfono no puede estar vacío 
      {/if}
      </td>
      </tr>
    {/if}
  </table>
  Fecha: 
  <input 
	  type="text" 
	  name="fecha" 
	  value="{$formVars.fecha|escape}" 
  >
  <br />
  Lugar: 
  <input 
	  type="text" 
	  name="lugar" 
	  value="{$formVars.lugar|escape}" 
  >
  <br />
 Distancia: 
  <input 
	  type="text" 
	  name="distancia" 
	  value="{$formVars.distancia|escape}" 
  >
  <br />
  Mapa
  <input 
	  type="text" 
	  name="mapa" 
	  value="{$formVars.mapa|escape}" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="id" value="{$formVars.id}" />
</form>
{include file="footer.tpl"}

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

  Nombre: 
  <input 
	  type="text" 
	  name="nombre" 
	  value="{$formVars.nombre|escape}" 
  >
  <br />
  Apellidos: 
  <input 
	  type="text" 
	  name="apellidos" 
	  value="{$formVars.apellidos|escape}" 
  >
  <br />
  DNI
  <input 
	  type="text" 
	  name="dni" 
	  value="{$formVars.dni|escape}" 
  >
  <br />
  Teléfono
  <input 
	  type="text" 
	  name="telefono" 
	  value="{$formVars.telefono|escape}" 
  >
  <br />
  Correo electrónico
  <input 
	  type="text" 
	  name="email" 
	  value="{$formVars.email|escape}" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="id" value="{$formVars.id}" />
</form>
{include file="footer.tpl"}

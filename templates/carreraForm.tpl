{* Smarty *}
{include file="header.tpl"}
{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
  <table border="0">
    {if $error ne ""}
      <tr>
      <td bgcolor="yellow" colspan="2">
      {if $error eq "Fecha_vacia"}
	   Oye colega, falta la fecha	
      {elseif $error eq "DNI_empty"}
	  	El DNI no puede estar vacío 
      {/if}
      </td>
      </tr>
    {/if}
  </table>

 Nombre: 
  <input 
	  type="text" 
	  name="Nombre" 
	  value="{$formVars.Nombre|escape}" 
  >
  <br />
 Distancia: 
  <input 
	  type="text" 
	  name="Distancia" 
	  value="{$formVars.Distancia|escape}" 
  >
  <br />
  DNI
  <input 
	  type="text" 
	  name="DNI" 
	  value="{$formVars.DNI|escape}" 
  >
  <br />
  Teléfono
  <input 
	  type="text" 
	  name="Telefono" 
	  value="{$formVars.Telefono|escape}" 
  >
  <br />
  Correo electrónico
  <input 
	  type="text" 
	  name="Email" 
	  value="{$formVars.Email|escape}" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="id" value="{$formVars.id}" />
</form>
{include file="footer.tpl"}

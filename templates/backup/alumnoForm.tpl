{* Smarty *}
{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
  <table border="0">
    {if $error ne ""}
      <tr>
      <td bgcolor="yellow" colspan="2">
      {if $error eq "Nombre_empty"}
	  	Se necesita un nombre
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
	  value="{$post.Nombre|escape}" 
  >
  <br />
  DNI
  <input 
	  type="text" 
	  name="DNI" 
	  value="{$post.DNI|escape}" 
  >
  <br />
  Teléfono
  <input 
	  type="text" 
	  name="Telefono" 
	  value="{$post.Telefono|escape}" 
  >
  <br />
  Correo electrónico
  <input 
	  type="text" 
	  name="Email" 
	  value="{$post.Email|escape}" 
  >
  <input type="submit" value="Submit">
  <input type="hidden" name="db_action" value="{$db_action}" />
  <input type="hidden" name="id" value="{$post.id}" />
</form>

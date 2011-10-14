{* Smarty *}

{include file="header.tpl"}
{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
  <table border="1">
    {if $error ne ""}
      <tr>
      <td bgcolor="yellow" colspan="2">
      {if $error eq "Asignaturas_empty"}
	  	Pon alguna asignatura
      {elseif $error eq "Importe_empty"} 
	  	Se necesita un importe	
      {/if}
      </td>
      </tr>
    {/if}
  </table>

  Lugar: 
  <input 
	  type="text" 
	  name="carrera_lugar" 
	  value="{$formVars.carrera_lugar|escape}" 
  >
  <br />
  Equipo:
  <input 
	  type="text" 
	  name="equipo_id" 
	  value="{$formVars.equipo_id|escape}" 
  >
  <br />
 Nombre del equipo: 
  <input 
	  type="text" 
	  name="equipo_nombre" 
	  value="{$formVars.equipo_nombre|escape}" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="masterId" value="{$masterId}" />
  <input type="hidden" name="id" value="{$id}" />
</form>
{include file="footer.tpl"}

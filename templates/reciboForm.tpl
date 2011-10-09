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

  Fecha: 
  <input 
	  type="text" 
	  name="Fecha" 
	  value="{$formVars.Fecha|escape}" 
  >
  <br />
  Asignaturas
  <input 
	  type="text" 
	  name="Asignaturas" 
	  value="{$formVars.Asignaturas|escape}" 
  >
  <br />
  Importe
  <input 
	  type="text" 
	  name="Importe" 
	  value="{$formVars.Importe|escape}" 
  >
  <br />
  Pagado
  <input 
	  type="text" 
	  name="Pagado" 
	  value="{$formVars.Pagado|escape}" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="masterId" value="{$masterId}" />
  <input type="hidden" name="id" value="{$id}" />
</form>
{include file="footer.tpl"}

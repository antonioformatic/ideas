{* Smarty *}

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
	  value="{$post.Fecha|escape}" 
  >
  <br />
  Asignaturas
  <input 
	  type="text" 
	  name="Asignaturas" 
	  value="{$post.Asignaturas|escape}" 
  >
  <br />
  Importe
  <input 
	  type="text" 
	  name="Importe" 
	  value="{$post.Importe|escape}" 
  >
  <br />
  Pagado
  <input 
	  type="text" 
	  name="Pagado" 
	  value="{$post.Pagado|escape}" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="db_action" value="{$db_action}" />
  <input type="hidden" name="masterId" value="{$masterId}" />
  <input type="hidden" name="id" value="{$id}" />
</form>

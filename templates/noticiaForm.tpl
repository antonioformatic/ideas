{* Smarty *}

{include file="header.tpl"}
{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
  <table border="1">
    {if $error ne ""}
      <tr>
      <td bgcolor="yellow" colspan="2">
      {if $error eq "importe_empty"}
	  	Pon algun importe 
      {elseif $error eq "concepto_empty"} 
	  	Se necesita un concepto 
      {elseif $error eq "fecha_empty"} 
	  	Se necesita una fecha 
      {/if}
      </td>
      </tr>
    {/if}
  </table>
<br />
  Texto: 
<textarea name="texto">{$formVars.texto|escape}</textarea>
<br />
Fecha: 
  <input 
	  type="text" 
	  name="fecha" 
	  value="{$formVars.fecha|escape}" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="masterId" value="{$masterId}" />
  <input type="hidden" name="id" value="{$id}" />
</form>
{include file="footer.tpl"}

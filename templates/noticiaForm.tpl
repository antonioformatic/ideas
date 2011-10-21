{* Smarty *}

{include file="header.tpl"}
{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
	<table border="0">
		{foreach from=$errors item="error"}
		<tr>
			<td bgcolor="yellow" colspan="2">
				{$error}
			</td>
		</tr>
		{/foreach}
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

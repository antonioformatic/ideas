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

  Nombre:
  <input 
	  type="text" 
	  name="nombre" 
	  value="{$formVars.nombre|escape}" 
  >
  <br />
  Password: 
  <input 
	  type="password" 
	  name="password" 
	  value="{$formVars.password|escape}" 
  >
  <br />
  Nivel: 
  <input 
	  type="text" 
	  name="nivel" 
	  value="{$formVars.nivel|escape}" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="id" value="{$id}" />
</form>
{include file="footer.tpl"}

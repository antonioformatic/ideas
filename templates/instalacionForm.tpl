{* Smarty *}

{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
  <table border="1">
    {if $error ne ""}
      <tr>
      <td bgcolor="yellow" colspan="2">
      {if $error eq "nombre_empty"}
	  	Pon algo en el nombre 
      {/if}
      </td>
      </tr>
    {/if}
  </table>
{html_select_date}
  Nombre: 
  <input 
	  type="text" 
	  name="nombre" 
	  value="{$formVars.nombre|escape}" 
  >
  <br />

 Actividades:
{assign var="lasActividades" value=","|explode:$formVars.actividades}
<select name="actividades[]"  size="{$data.posiblesActividades|@count}" multiple>
	{foreach from=$data.posiblesActividades item=posibleActividad} 
				<option value="{$posibleActividad}"
				{foreach from=$lasActividades item=actividad} 
					{if $actividad == $posibleActividad}
						selected="selected"
					{/if}
				{/foreach} 
				>{$posibleActividad}</option> 
	{/foreach} 
</select>

  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="db_action" value="{$db_action}" />
  <input type="hidden" name="id" value="{$id}" />
</form>

{* Smarty *}

{include file="menu.tpl"}
<td><a href="{$SCRIPT_NAME}?action=close"  >
	<img src="images/up.gif" width="32" height="32" /></a>
</td>
<table border="0" width="300">
	<th bgcolor="#d1d1d1">&nbsp;</th>
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Nombre </th>
	<th bgcolor="#d1d1d1">DNI    </th>
	<th bgcolor="#d1d1d1">Telefono</th>
	<th bgcolor="#d1d1d1">Correo eletrónico</th>
	{foreach from=$data item="entry"}
    <tr bgcolor="{cycle values="#dedede,#eeeeee" advance=false}">
        <td><a href="{$SCRIPT_NAME}?action=open&id={$entry.id}&masterId={$entry.id}"  >
			<img src="images/open.png" width="32" height="32" /></a>
		</td>
		<td>
			{$entry.id|escape}
		</td>        
		<td>
			{$entry.Nombre|escape}
		</td>        
		<td>
			{$entry.DNI|escape}
		</td>        
		<td>
			{$entry.Telefono|escape}
		</td>        
		<td>
			{$entry.Email|escape}
		</td>        
        <td><a href="{$SCRIPT_NAME}?action=edit&id={$entry.id}"  >
			<img src="images/edit.png" width="32" height="32" /></a>
		</td>
        <td><a href="{$SCRIPT_NAME}?action=delete&id={$entry.id}">
			<img src="images/delete.jpg" width="32" height="32" /></a>
		</td>
	</tr>
    {foreachelse}
      <tr>
        <td colspan="2">No hay datos</td>
      </tr>
  {/foreach}
</table>
<table border="0">
	<tr>
		<td>
			<a href="{$SCRIPT_NAME}?action=goFirst">
				<img src="images/first.gif" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goPrev">
				<img src="images/prev.gif" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goNext">
				<img src="images/next.gif" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goLast">
				<img src="images/last.gif" />
			</a>
		</td>
	</tr>
</table>
<a href="{$SCRIPT_NAME}?action=add"><img src="images/add.png" width="32" height="32" /></a>

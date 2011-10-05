{* Smarty *}

{include file="menu.tpl"}
<td><a href="{$SCRIPT_NAME}?action=close"  >
	<img src="images/up.gif" width="32" height="32" /></a>
</td>
<table border="0" width="300">
	<th bgcolor="#d1d1d1">&nbsp;</th>
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Fecha  </th>
	<th bgcolor="#d1d1d1">Asignaturas</th>
	<th bgcolor="#d1d1d1">Importe</th>
	<th bgcolor="#d1d1d1">Pagado</th>
	{foreach from=$data item="entry"}
    <tr bgcolor="{cycle values="#dedede,#eeeeee" advance=false}">
		<td>
			{$entry.id|escape}
		</td>        
		<td>
			{$entry.Fecha|escape}
		</td>        
		<td>
			{$entry.Asignaturas|escape}
		</td>        
		<td>
			{$entry.Importe|escape}
		</td>        
		<td>
			{$entry.Pagado|escape}
		</td>        
        <td><a href="{$SCRIPT_NAME}?action=edit&id={$entry.id}&masterId={$masterId}"  >
			<img src="images/edit.png" width="32" height="32" /></a>
		</td>
        <td><a href="{$SCRIPT_NAME}?action=delete&id={$entry.id}&masterId={$masterId}">
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
			<a href="{$SCRIPT_NAME}?action=goFirst&masterId={$masterId}">
				<img src="images/first.gif" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goPrev&masterId={$masterId}">
				<img src="images/prev.gif" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goNext&masterId={$masterId}">
				<img src="images/next.gif" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goLast&masterId={$masterId}">
				<img src="images/last.gif" />
			</a>
		</td>
	</tr>
</table>
<a href="{$SCRIPT_NAME}?action=add&masterId={$masterId}"><img src="images/add.png" width="32" height="32" /></a>

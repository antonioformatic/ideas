{* Smarty *}

{include file="header.tpl"}
{include file="menu.tpl"}
<td><a href="{$SCRIPT_NAME}?action=close&view=menu"  >
	<button>&uarr;</button>
</a>
<table border="0" >
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Nombre</th>
	<th bgcolor="#d1d1d1">Password</th>
	<th bgcolor="#d1d1d1">Nivel</th>
	{foreach from=$records item="record"}
    <tr bgcolor="{cycle values="#dedede,#eeeeee" advance=false}">
		<td>
			{$record.id|escape}
		</td>        
		<td>
			{$record.nombre|escape}
		</td>        
		<td>
			{$record.password|escape}
		</td>        
		<td>
			{$record.nivel|escape}
		</td>        
        <td><a href="{$SCRIPT_NAME}?action=edit&id={$record.id}"  >
			<button>.</button></a>
		</td>
        <td><a href="{$SCRIPT_NAME}?action=delete&id={$record.id}">
			<button>X</button></a>
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
				<button>&#124;&lt;</button></a>
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goPrev">
				<button>&lt;</button></a>
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goNext">
				<button>&gt;</button></a>
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goLast">
				<button>&gt;&#124;</button></a>
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=add&view=usuario">
				<button>+</button></a>
			</a>
		</td>
	</tr>
</table>
{include file="footer.tpl"}

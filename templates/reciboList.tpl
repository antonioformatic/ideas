{* Smarty *}

{include file="menu.tpl"}
<td><a href="{$SCRIPT_NAME}?action=close&view=alumno"  >
<<<<<<< HEAD
	<img src="images/close.png" width="32" height="32" /></a>
=======
	<button>&uarr;</button>
>>>>>>> beta1
</td>
<table border="0" width="300">
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Fecha  </th>
	<th bgcolor="#d1d1d1">Asignaturas</th>
	<th bgcolor="#d1d1d1">Importe</th>
	<th bgcolor="#d1d1d1">Pagado</th>
	{foreach from=$data item="entry"}
    <tr bgcolor="{cycle values="#dedede,#eeeeee" advance=true}">
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
			<button>.</button></a>
		</td>
        <td><a href="{$SCRIPT_NAME}?action=delete&id={$entry.id}&masterId={$masterId}">
<<<<<<< HEAD
			<img src="images/delete.png" width="32" height="32" /></a>
=======
			<button>X</button></a>
>>>>>>> beta1
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
<<<<<<< HEAD
			<a href="{$SCRIPT_NAME}?action=goFirst&masterId={$masterId}">
				<img src="images/first.png" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goPrev&masterId={$masterId}">
				<img src="images/prev.png" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goNext&masterId={$masterId}">
				<img src="images/next.png" />
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goLast&masterId={$masterId}">
				<img src="images/last.png" />
=======
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
			<a href="{$SCRIPT_NAME}?action=add&view=alumno">
				<button>+</button></a>
>>>>>>> beta1
			</a>
		</td>
	</tr>
</table>

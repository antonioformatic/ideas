{* Smarty *}

{include file="menu.tpl"}
<td><a href="{$SCRIPT_NAME}?action=close&view=menu"  >
<<<<<<< HEAD
	<img src="images/close.png" width="32" height="32" /></a>
=======
	<button>&uarr;</button>
</a>
>>>>>>> beta1
</td>
<table border="0" width="300">
	<th bgcolor="#d1d1d1">&nbsp;</th>
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Nombre </th>
	<th bgcolor="#d1d1d1">DNI    </th>
	<th bgcolor="#d1d1d1">Telefono</th>
	<th bgcolor="#d1d1d1">Correo eletrónico</th>
	{foreach from=$data item="entry"}
    <tr bgcolor="{cycle values="#dedede,#eeeeee" advance=true}">
        <td><a href="{$SCRIPT_NAME}?action=open&view=recibo&id={$entry.id}&masterId={$entry.id}"  >
			<button>&darr;</button>
			</a>
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
			<button>.</button></a>
		</td>
        <td><a href="{$SCRIPT_NAME}?action=delete&id={$entry.id}">
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
			<a href="{$SCRIPT_NAME}?action=goFirst">
<<<<<<< HEAD
				<img src="images/first.png" />
=======
				<button>&#124;&lt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goPrev">
<<<<<<< HEAD
				<img src="images/prev.png" />
=======
				<button>&lt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goNext">
<<<<<<< HEAD
				<img src="images/next.png" />
=======
				<button>&gt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="{$SCRIPT_NAME}?action=goLast">
<<<<<<< HEAD
				<img src="images/last.png" />
=======
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

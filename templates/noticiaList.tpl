{* Smarty *}

{include file="menu.tpl"}
<td><a href="{$SCRIPT_NAME}?action=close&view=menu"  >
<<<<<<< HEAD
	<img src="images/close.png" width="32" height="32" /></a>
</td>
=======
	<button>&uarr;</button>
</a>
>>>>>>> beta1
<table border="0" >
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Titulo</th>
	<th bgcolor="#d1d1d1">Texto</th>
	{foreach from=$data item="entry"}
    <tr bgcolor="{cycle values="#dedede,#eeeeee" advance=false}">
		<td>
			{$entry.id|escape}
		</td>        
		<td>
			{$entry.titulo|escape}
		</td>        
		<td>
			{$entry.texto|escape}
		</td>        
        <td><a href="{$SCRIPT_NAME}?action=edit&id={$entry.id}"  >
			<button>.</button></a>
		</td>
<<<<<<< HEAD
        <td><a href="{$SCRIPT_NAME}?action=delete&id={$entry.id}&masterId={$masterId}">
			<img src="images/delete.png" width="32" height="32" /></a>
=======
        <td><a href="{$SCRIPT_NAME}?action=delete&id={$entry.id}">
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

{* Smarty *}

{include file="header.tpl"}
{include file="menu.tpl"}
<td><a href="{$SCRIPT_NAME}?action=close&view=inicio"  >
	<button>&uarr;</button>
	</a>
</td>
<table border="0" >
	<th bgcolor="#d1d1d1">id </th>
	<th bgcolor="#d1d1d1">Fecha  </th>
	<th bgcolor="#d1d1d1">Conceptos</th>
	<th bgcolor="#d1d1d1">Importe</th>
	<th bgcolor="#d1d1d1">Fecha de pago</th>
	<th bgcolor="#d1d1d1">Alumno</th>
	<th bgcolor="#d1d1d1">Nombre</th>
	<th bgcolor="#d1d1d1">Apellidos</th>
	<th bgcolor="#d1d1d1">Email</th>
	<th bgcolor="#d1d1d1">Dni</th>
	{foreach from=$records item="record"}
    <tr bgcolor="{cycle values="#dedede,#eeeeee" advance=true}">
		<td>
			{$record.id|escape}
		</td>        
		<td>
			{$record.fecha|escape}
		</td>        
		<td>
			{$record.concepto|escape}
		</td>        
		<td>
			{$record.importe|escape}
		</td>        
		<td>
			{$record.fecha_pago|escape}
		</td>        
		<td>
			{$record.alumno_id|escape}
		</td>        
		<td>
			{$record.nombre|escape}
		</td>        
		<td>
			{$record.apellidos|escape}
		</td>        
		<td>
			{$record.email|escape}
		</td>        
		<td>
			{$record.dni|escape}
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
	</tr>
</table>
{include file="footer.tpl"}

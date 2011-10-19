<form action=  "{$SCRIPT_NAME}?action=orderBy" method="post">
<select name="orderField">
	{html_options values=array_keys($records[0]) output=array_keys($records[0]) selected ='id'}
</select>
<input type="submit" value="Ordenar">
</form>
<table border="0" >
	{foreach from=$data->colModel item="col"}
		<th bgcolor="#d1d1d1">{$col->display}</th>
	{/foreach}
{if $data->edit eq "true"}
	<th bgcolor="#d1d1d1">&nbsp;</th>
{/if}
{if $data->delete eq "true"}
	<th bgcolor="#d1d1d1">&nbsp;</th>
{/if}
	{foreach from=$records item="record"}
		<tr bgcolor="{cycle values="#dedede,#eeeeee" advance=true}">
        <td><a href="{$SCRIPT_NAME}?action=open&view={$detailView}&id={$record.id}&masterId={$record.id}"  >
			<button>&darr;</button>
			</a>
		</td>
			{foreach from=$data->colModel item="col"}
				<td>
					{$record.{$col->name}|escape}
				</td>        
			{/foreach}
			{if $data->edit eq "true"}
				<td><a href="{$SCRIPT_NAME}?action=edit&id={$record.id}"  >
					<button>.</button></a>
				</td>
			{/if}
			{if $data->delete eq "true"}
				<td><a href="{$SCRIPT_NAME}?action=delete&id={$record.id}">
					<button>X</button></a>
				</td>
			{/if}
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
{if $data->add eq "true"}
		<td>
			<a href="{$SCRIPT_NAME}?action=add">
				<button>+</button></a>
			</a>
		</td>
{/if}
	</tr>
</table>

<form action="{$SCRIPT_NAME}?action=submit" method="post" enctype='multipart/form-data'>
	<table border="0">
		{if $error ne ""}
			<tr>
			<td bgcolor="yellow" colspan="2">
				{if $error eq "nombre_empty"}
					Se necesita un nombre
				{elseif $error eq "apellidos_empty"}
					Los apellidos no pueden estar vacíos 
				{elseif $error eq "dni_empty"}
					El DNI no puede estar vacío 
				{elseif $error eq "telefono_empty"}
					El teléfono no puede estar vacío 
				{/if}
			</td>
			</tr>
		{/if}
	</table>
	{foreach from=$data->colModel item="col"}
		{if $col->type eq "text"}
			{$col->display}: <input name="{$col->value|escape}" value="{$formVars.{$col->value}|escape}" />
		{elseif $col->type eq "date"}
			{$col->display}: <input class="date" name="{$col->value|escape}" value="{$formVars.{$col->value}|escape}" />
		{elseif $col->type eq "image"}
			{$col->display}:
			<img src="images/{$formVars.{$col->value}|escape}" />
			<input class="file" type ="file" accept="image/gif,image/jpeg,image/png" name="{$col->value|escape}" value="{$formVars.{$col->value}|escape}" />
		{elseif $col->type eq "textarea"}
			{$col->display}:<textarea cols="{$col->width}" rows="{$col->height}" name="{$col->value|escape}">{$formVars.{$col->value}|escape}</textarea>
		{elseif $col->type eq "menu"}
			{$col->display}:
			<select name="{$col->value|escape}">
			   {html_options values=$col->options output=$col->options selected="{$formVars.{$col->value}|escape}"}
		   </select>
		{elseif $col->type eq "lookup"}
			{$col->display}:
			<input
				type = "text"
				class = "lookup"
				size= "{$col->width}"
				name="{$col->value}"           
				id = "lookup_{$col->value}"
				value="{$formVars.{$col->value}|escape}" 
				database="{$col->database}"
				table="{$col->table}"
				fieldSearch="{$col->fieldSearch}"
				fieldRet="{$col->fieldRet}"
				>
		{elseif $col->type eq "external"}
			<div
				class="externalField"
				database="{$col->database}"
				table="{$col->table}"
				value_id="lookup_{$col->value_id}" 
				fieldRet="{$col->fieldRet}"
			></div>
		{/if}
		<br /> 
	{/foreach}
	<input type="submit" value="Enviar" />
	<input type="reset" value="Reset" />
	<input type="hidden" name="id" value="{$formVars.id}" />
</form>

{* Smarty *}
{include file="header.tpl"}
{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
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
  Nombre:
  <input 
	  type="text" 
	  name="nombre"              
	  value="{$formVars.nombre|escape}" 
  >
  <br />
  Dirección:
  <input 
	  type="text" 
	  name="direccion"           
	  value="{$formVars.direccion|escape}" 
  >
  <br />
  Teléfono:
  <input 
	  type="text" 
	  name="telefono"            
	  value="{$formVars.telefono|escape}" 
  >
  <br />
  Email:
  <input 
	  type="text" 
	  name="email"               
	  value="{$formVars.email|escape}" 
  >
  <br />
  Fecha de nacimiento:
  <input 
	  type="text" 
	  name="fecha_de_nacimiento" 
	  value="{$formVars.fecha_de_nacimiento|escape}" 
  >
  <br />
  Foto:
  <input 
	  type="text" 
	  name="foto"                
	  value="{$formVars.foto|escape}" 
  >
  <br />
  Equipo:
<input
	class = "lookup"
	type = "text"
	size="4"
	name="equipo_id"           
	id = "idDelEquipo"
	value="{$formVars.equipo_id|escape}" 
	database="carrilanas"
	table="equipo"
	fieldSearch="nombre"
	fieldRet="id"
	>
<div
	style="display:inline;"
	class="externalField"
	database="carrilanas"
	table="equipo"
	value_id="idDelEquipo" 
	fieldRet="nombre"
></div>
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="id" value="{$formVars.id}" />
</form>
{include file="footer.tpl"}

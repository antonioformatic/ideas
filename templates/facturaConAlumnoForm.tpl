{* Smarty *}

{include file="header.tpl"}
{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
  <table border="1">
    {if $error ne ""}
      <tr>
      <td bgcolor="yellow" colspan="2">
      {if $error eq "Asignaturas_empty"}
	  	Pon alguna asignatura
      {elseif $error eq "Importe_empty"} 
	  	Se necesita un importe	
      {/if}
      </td>
      </tr>
    {/if}
  </table>

  Fecha: 
  <input 
	  type="text" 
	  name="fecha" 
	  value="{$formVars.fecha|escape}" 
  >
  <br />
  Conceptos:
  <input 
	  type="text" 
	  name="concepto" 
	  value="{$formVars.concepto|escape}" 
  >
  <br />
  Importe
  <input 
	  type="text" 
	  name="importe" 
	  value="{$formVars.importe|escape}" 
  >
  <br />
  Fecha de pago: 
  <input 
	  type="text" 
	  name="fecha_pago" 
	  value="{$formVars.fecha_pago|escape}" 
  >
  Alumno: 
  <input 
	  type="text" 
	  name="alumno_id" 
	  value="{$formVars.alumno_id|escape}" 
	  class="lookup"
	  database="formatic"
	  table="alumno"
	  fieldSearch="nombre,apellidos"
	  fieldRet="id"
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="masterId" value="{$masterId}" />
  <input type="hidden" name="id" value="{$id}" />
</form>
{include file="footer.tpl"}

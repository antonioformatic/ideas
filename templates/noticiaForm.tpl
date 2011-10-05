{* Smarty *}

{include file="menu.tpl"}
<form action="{$SCRIPT_NAME}?action=submit" method="post">
  <table border="1">
    {if $error ne ""}
      <tr>
      <td bgcolor="yellow" colspan="2">
      {if $error eq "titulo_empty"}
	  	Pon algo como título 
      {elseif $error eq "texto_empty"} 
	   	Pon algo en el texto	
      {/if}
      </td>
      </tr>
    {/if}
  </table>

  Título: 
  <input 
	  type="text" 
	  name="titulo" 
	  value="{$post.titulo|escape}" 
  >
  <br />
 Texto:
  <textarea name="texto" rows="4" cols="40">
	  {$post.texto|escape} 
  </textarea>
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="db_action" value="{$db_action}" />
  <input type="hidden" name="id" value="{$id}" />
</form>

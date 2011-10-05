<?php /* Smarty version Smarty-3.0.7, created on 2011-10-06 00:35:17
         compiled from "templates/noticiaForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15618385014e8c93aec48d65-79465064%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb6a1f67d682f2b52940fbfb13cb4bcadfef6bf9' => 
    array (
      0 => 'templates/noticiaForm.tpl',
      1 => 1317836126,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15618385014e8c93aec48d65-79465064',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'smarty/plugins/modifier.escape.php';
?>

<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<form action="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=submit" method="post">
  <table border="1">
    <?php if ($_smarty_tpl->getVariable('error')->value!=''){?>
      <tr>
      <td bgcolor="yellow" colspan="2">
      <?php if ($_smarty_tpl->getVariable('error')->value=="titulo_empty"){?>
	  	Pon algo como título 
      <?php }elseif($_smarty_tpl->getVariable('error')->value=="texto_empty"){?> 
	   	Pon algo en el texto	
      <?php }?>
      </td>
      </tr>
    <?php }?>
  </table>

  Título: 
  <input 
	  type="text" 
	  name="titulo" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value['titulo']);?>
" 
  >
  <br />
 Texto:
  <textarea name="texto" rows="4" cols="40">
	  <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value['texto']);?>
 
  </textarea>
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="db_action" value="<?php echo $_smarty_tpl->getVariable('db_action')->value;?>
" />
  <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
</form>

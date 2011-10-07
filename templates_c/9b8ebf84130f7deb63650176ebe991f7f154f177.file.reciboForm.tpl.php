<?php /* Smarty version Smarty-3.0.7, created on 2011-10-07 11:39:50
         compiled from "templates/reciboForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20575825324e8ec8e6b63344-18350908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b8ebf84130f7deb63650176ebe991f7f154f177' => 
    array (
      0 => 'templates/reciboForm.tpl',
      1 => 1317979965,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20575825324e8ec8e6b63344-18350908',
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
      <?php if ($_smarty_tpl->getVariable('error')->value=="Asignaturas_empty"){?>
	  	Pon alguna asignatura
      <?php }elseif($_smarty_tpl->getVariable('error')->value=="Importe_empty"){?> 
	  	Se necesita un importe	
      <?php }?>
      </td>
      </tr>
    <?php }?>
  </table>

  Fecha: 
  <input 
	  type="text" 
	  name="Fecha" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['Fecha']);?>
" 
  >
  <br />
  Asignaturas
  <input 
	  type="text" 
	  name="Asignaturas" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['Asignaturas']);?>
" 
  >
  <br />
  Importe
  <input 
	  type="text" 
	  name="Importe" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['Importe']);?>
" 
  >
  <br />
  Pagado
  <input 
	  type="text" 
	  name="Pagado" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['Pagado']);?>
" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="db_action" value="<?php echo $_smarty_tpl->getVariable('db_action')->value;?>
" />
  <input type="hidden" name="masterId" value="<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
" />
  <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
</form>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

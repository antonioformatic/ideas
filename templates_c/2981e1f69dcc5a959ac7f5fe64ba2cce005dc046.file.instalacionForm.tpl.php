<?php /* Smarty version Smarty-3.0.7, created on 2011-10-07 11:40:37
         compiled from "templates/instalacionForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19377878654e8ec915b0d473-26477933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2981e1f69dcc5a959ac7f5fe64ba2cce005dc046' => 
    array (
      0 => 'templates/instalacionForm.tpl',
      1 => 1317980433,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19377878654e8ec915b0d473-26477933',
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
      <?php if ($_smarty_tpl->getVariable('error')->value=="nombre_empty"){?>
	  	Pon algo en el nombre 
      <?php }?>
      </td>
      </tr>
    <?php }?>
  </table>
  Nombre: 
  <input 
	  type="text" 
	  name="nombre" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['nombre']);?>
" 
  >
  <br />

 Actividades:
<?php $_smarty_tpl->tpl_vars["lasActividades"] = new Smarty_variable(explode(",",$_smarty_tpl->getVariable('formVars')->value['actividades']), null, null);?>
<select name="actividades[]"  size="<?php echo count($_smarty_tpl->getVariable('data')->value['posiblesActividades']);?>
" multiple>
	<?php  $_smarty_tpl->tpl_vars['posibleActividad'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value['posiblesActividades']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['posibleActividad']->key => $_smarty_tpl->tpl_vars['posibleActividad']->value){
?> 
				<option value="<?php echo $_smarty_tpl->tpl_vars['posibleActividad']->value;?>
"
				<?php  $_smarty_tpl->tpl_vars['actividad'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lasActividades')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['actividad']->key => $_smarty_tpl->tpl_vars['actividad']->value){
?> 
					<?php if ($_smarty_tpl->tpl_vars['actividad']->value==$_smarty_tpl->tpl_vars['posibleActividad']->value){?>
						selected="selected"
					<?php }?>
				<?php }} ?> 
				><?php echo $_smarty_tpl->tpl_vars['posibleActividad']->value;?>
</option> 
	<?php }} ?> 
</select>

  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="db_action" value="<?php echo $_smarty_tpl->getVariable('db_action')->value;?>
" />
  <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
</form>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 13:49:51
         compiled from "templates/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7338112094e8c445fbb6d92-29112114%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6da4162c469d98c5e879f8e0b21e18d44108090' => 
    array (
      0 => 'templates/menu.tpl',
      1 => 1317815389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7338112094e8c445fbb6d92-29112114',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ul id="navigation"> 
<?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('opciones')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value){
 $_smarty_tpl->tpl_vars['title']->value = $_smarty_tpl->tpl_vars['page']->key;
?> 
   <li> 
		<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?view=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"> 
			<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
<br /> 
		</a> 
	</li> 
<?php }} ?> 
</ul>

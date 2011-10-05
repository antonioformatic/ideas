<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 11:36:01
         compiled from "templates/alumnoMenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1884577384e8c2501888ff4-58652077%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '180c2c82427e9139efcaf7da33c8db34354524e1' => 
    array (
      0 => 'templates/alumnoMenu.tpl',
      1 => 1317807358,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1884577384e8c2501888ff4-58652077',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
Esto es un alumno <p>
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=open"> 
	Abrir <br /> 
</a> 
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=close"> 
	Cerrar <br /> 
</a> 




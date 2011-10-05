<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 11:35:47
         compiled from "templates/profesorMenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20796393794e8c24f314d287-20526947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7bf5cc61f74e940e4d1057e167f9700e48b118e8' => 
    array (
      0 => 'templates/profesorMenu.tpl',
      1 => 1317807345,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20796393794e8c24f314d287-20526947',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
Esto es un profesor <p>
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=open"> 
	Abrir <br /> 
</a> 
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=close"> 
	Cerrar <br /> 
</a> 


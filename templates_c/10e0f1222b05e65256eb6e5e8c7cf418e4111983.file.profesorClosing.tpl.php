<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 11:36:54
         compiled from "templates/profesorClosing.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4101971464e8c2536272898-03152869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10e0f1222b05e65256eb6e5e8c7cf418e4111983' => 
    array (
      0 => 'templates/profesorClosing.tpl',
      1 => 1317807393,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4101971464e8c2536272898-03152869',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
Soy el profesor y me llamo <?php echo $_smarty_tpl->getVariable('name')->value;?>
 y estamos cerrando <p>
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=open"> 
	Abrir <br /> 
</a> 
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=close"> 
	Cerrar <br /> 
</a> 


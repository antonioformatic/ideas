<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 13:26:01
         compiled from "templates/alumnoClosing.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14439320764e8c3ec94dac29-11844561%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e93120c1e04cbb49cf8abc604032a0804f9b009' => 
    array (
      0 => 'templates/alumnoClosing.tpl',
      1 => 1317813940,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14439320764e8c3ec94dac29-11844561',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
Soy el alumno y me llamo <?php echo $_smarty_tpl->getVariable('name')->value;?>
 y estamos cerrando <p>
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=open"> 
	Abrir <br /> 
</a> 
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=close"> 
	Cerrar <br /> 
</a> 


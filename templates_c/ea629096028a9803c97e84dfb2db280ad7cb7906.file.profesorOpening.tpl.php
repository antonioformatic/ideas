<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 13:26:04
         compiled from "templates/profesorOpening.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18461084884e8c3ecc3fa3a7-23567671%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea629096028a9803c97e84dfb2db280ad7cb7906' => 
    array (
      0 => 'templates/profesorOpening.tpl',
      1 => 1317813950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18461084884e8c3ecc3fa3a7-23567671',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
Soy el profesor y me llamo <?php echo $_smarty_tpl->getVariable('name')->value;?>
 <p>
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=open"> 
	Abrir <br /> 
</a> 
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=close"> 
	Cerrar <br /> 
</a> 


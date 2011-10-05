<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 13:25:58
         compiled from "templates/alumnoOpening.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21225369664e8c3ec6285d66-39089334%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e64590c18127bb253dd2594e68ef9dc23dbcd960' => 
    array (
      0 => 'templates/alumnoOpening.tpl',
      1 => 1317813945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21225369664e8c3ec6285d66-39089334',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
Soy el alumno y me llamo <?php echo $_smarty_tpl->getVariable('name')->value;?>
 y estamos abriendo <p>
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=open"> 
	Abrir <br /> 
</a> 
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=close"> 
	Cerrar <br /> 
</a> 



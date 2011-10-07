<?php /* Smarty version Smarty-3.0.7, created on 2011-10-07 12:08:55
         compiled from "templates/alumnoForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:398658184e8ecfb7417927-34145075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9dad57d6b0077505ea50e2825e543df97d9362f5' => 
    array (
      0 => 'templates/alumnoForm.tpl',
      1 => 1317982133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '398658184e8ecfb7417927-34145075',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'smarty/plugins/modifier.escape.php';
?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<form action="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=submit" method="post">
  <table border="0">
    <?php if ($_smarty_tpl->getVariable('error')->value!=''){?>
      <tr>
      <td bgcolor="yellow" colspan="2">
      <?php if ($_smarty_tpl->getVariable('error')->value=="Nombre_empty"){?>
	  	Se necesita un nombre
      <?php }elseif($_smarty_tpl->getVariable('error')->value=="DNI_empty"){?>
	  	El DNI no puede estar vacío 
      <?php }?>
      </td>
      </tr>
    <?php }?>
  </table>

  Buscar esto:
				<input 
					class=      "lookup" 
					database=   "academia" 
					table=      "alumno" 
					fieldSearch="Nombre"
					fieldRet   ="id"
				/>
  Nombre: 
  <input 
	  type="text" 
	  name="Nombre" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['Nombre']);?>
" 
  >
  <br />
  DNI
  <input 
	  type="text" 
	  name="DNI" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['DNI']);?>
" 
  >
  <br />
  Teléfono
  <input 
	  type="text" 
	  name="Telefono" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['Telefono']);?>
" 
  >
  <br />
  Correo electrónico
  <input 
	  type="text" 
	  name="Email" 
	  value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('formVars')->value['Email']);?>
" 
  >
  <br />
  <input type="submit" value="Submit">
  <input type="hidden" name="db_action" value="<?php echo $_smarty_tpl->getVariable('db_action')->value;?>
" />
  <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('formVars')->value['id'];?>
" />
</form>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

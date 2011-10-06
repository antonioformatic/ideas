<<<<<<< HEAD
<?php /* Smarty version Smarty-3.0.7, created on 2011-10-06 02:00:13
         compiled from "templates/alumnoList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16937681344e8cef8d4f8be8-86711456%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
=======
<?php /* Smarty version Smarty-3.0.7, created on 2011-10-06 10:15:28
         compiled from "templates/alumnoList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20521205984e8d63a01fc537-85942113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
>>>>>>> beta1
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28b71fdc1ee126b623f8450742b0db189e12aadc' => 
    array (
      0 => 'templates/alumnoList.tpl',
<<<<<<< HEAD
      1 => 1317859201,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16937681344e8cef8d4f8be8-86711456',
=======
      1 => 1317888927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20521205984e8d63a01fc537-85942113',
>>>>>>> beta1
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include 'smarty/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_escape')) include 'smarty/plugins/modifier.escape.php';
?>

<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=close&view=menu"  >
<<<<<<< HEAD
	<img src="images/close.png" width="32" height="32" /></a>
=======
	<button>&uarr;</button>
</a>
>>>>>>> beta1
</td>
<table border="0" width="300">
	<th bgcolor="#d1d1d1">&nbsp;</th>
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Nombre </th>
	<th bgcolor="#d1d1d1">DNI    </th>
	<th bgcolor="#d1d1d1">Telefono</th>
	<th bgcolor="#d1d1d1">Correo eletrónico</th>
	<?php  $_smarty_tpl->tpl_vars["entry"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["entry"]->key => $_smarty_tpl->tpl_vars["entry"]->value){
?>
    <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#dedede,#eeeeee",'advance'=>true),$_smarty_tpl);?>
">
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=open&view=recibo&id=<?php echo $_smarty_tpl->getVariable('entry')->value['id'];?>
&masterId=<?php echo $_smarty_tpl->getVariable('entry')->value['id'];?>
"  >
			<button>&darr;</button>
			</a>
		</td>
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['id']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Nombre']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['DNI']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Telefono']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Email']);?>

		</td>        
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=edit&id=<?php echo $_smarty_tpl->getVariable('entry')->value['id'];?>
"  >
			<button>.</button></a>
		</td>
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=delete&id=<?php echo $_smarty_tpl->getVariable('entry')->value['id'];?>
">
<<<<<<< HEAD
			<img src="images/delete.png" width="32" height="32" /></a>
=======
			<button>X</button></a>
>>>>>>> beta1
		</td>
	</tr>
    <?php }} else { ?>
      <tr>
        <td colspan="2">No hay datos</td>
      </tr>
  <?php } ?>
</table>
<table border="0">
	<tr>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goFirst">
<<<<<<< HEAD
				<img src="images/first.png" />
=======
				<button>&#124;&lt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goPrev">
<<<<<<< HEAD
				<img src="images/prev.png" />
=======
				<button>&lt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goNext">
<<<<<<< HEAD
				<img src="images/next.png" />
=======
				<button>&gt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goLast">
<<<<<<< HEAD
				<img src="images/last.png" />
=======
				<button>&gt;&#124;</button></a>
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=add&view=alumno">
				<button>+</button></a>
>>>>>>> beta1
			</a>
		</td>
	</tr>
</table>

<<<<<<< HEAD
<?php /* Smarty version Smarty-3.0.7, created on 2011-10-06 01:58:49
         compiled from "templates/reciboList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6582533084e8cef391eac06-56951295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
=======
<?php /* Smarty version Smarty-3.0.7, created on 2011-10-06 10:15:47
         compiled from "templates/reciboList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15795810774e8d63b357ff63-76466391%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
>>>>>>> beta1
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '302dfccbe04eb745ddcf4c6926a8a708913ce77d' => 
    array (
      0 => 'templates/reciboList.tpl',
<<<<<<< HEAD
      1 => 1317859111,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6582533084e8cef391eac06-56951295',
=======
      1 => 1317888944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15795810774e8d63b357ff63-76466391',
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
?action=close&view=alumno"  >
<<<<<<< HEAD
	<img src="images/up.png" width="32" height="32" /></a>
=======
	<button>&uarr;</button>
>>>>>>> beta1
</td>
<table border="0" width="300">
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Fecha  </th>
	<th bgcolor="#d1d1d1">Asignaturas</th>
	<th bgcolor="#d1d1d1">Importe</th>
	<th bgcolor="#d1d1d1">Pagado</th>
	<?php  $_smarty_tpl->tpl_vars["entry"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["entry"]->key => $_smarty_tpl->tpl_vars["entry"]->value){
?>
    <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#dedede,#eeeeee",'advance'=>true),$_smarty_tpl);?>
">
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['id']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Fecha']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Asignaturas']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Importe']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Pagado']);?>

		</td>        
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=edit&id=<?php echo $_smarty_tpl->getVariable('entry')->value['id'];?>
&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
"  >
			<button>.</button></a>
		</td>
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=delete&id=<?php echo $_smarty_tpl->getVariable('entry')->value['id'];?>
&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
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
<<<<<<< HEAD
?action=goFirst&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
				<img src="images/first.png" />
=======
?action=goFirst">
				<button>&#124;&lt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
<<<<<<< HEAD
?action=goPrev&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
				<img src="images/prev.png" />
=======
?action=goPrev">
				<button>&lt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
<<<<<<< HEAD
?action=goNext&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
				<img src="images/next.png" />
=======
?action=goNext">
				<button>&gt;</button></a>
>>>>>>> beta1
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
<<<<<<< HEAD
?action=goLast&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
				<img src="images/last.png" />
=======
?action=goLast">
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

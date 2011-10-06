<?php /* Smarty version Smarty-3.0.7, created on 2011-10-06 17:30:01
         compiled from "templates/noticiaList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16821301974e8dc9795b6c86-13902822%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95df9cdbbb08f84a856228d840a28443c47b1ae9' => 
    array (
      0 => 'templates/noticiaList.tpl',
      1 => 1317913194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16821301974e8dc9795b6c86-13902822',
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
	<button>&uarr;</button>
</a>
<table border="0" >
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Titulo</th>
	<th bgcolor="#d1d1d1">Texto</th>
	<?php  $_smarty_tpl->tpl_vars["record"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('records')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["record"]->key => $_smarty_tpl->tpl_vars["record"]->value){
?>
    <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#dedede,#eeeeee",'advance'=>false),$_smarty_tpl);?>
">
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('record')->value['id']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('record')->value['titulo']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('record')->value['texto']);?>

		</td>        
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=edit&id=<?php echo $_smarty_tpl->getVariable('record')->value['id'];?>
"  >
			<button>.</button></a>
		</td>
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=delete&id=<?php echo $_smarty_tpl->getVariable('record')->value['id'];?>
">
			<button>X</button></a>
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
				<button>&#124;&lt;</button></a>
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goPrev">
				<button>&lt;</button></a>
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goNext">
				<button>&gt;</button></a>
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goLast">
				<button>&gt;&#124;</button></a>
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=add&view=noticia">
				<button>+</button></a>
			</a>
		</td>
	</tr>
</table>

<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 19:49:35
         compiled from "templates/noticiaList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8127408224e8c9801ae72c2-75545416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95df9cdbbb08f84a856228d840a28443c47b1ae9' => 
    array (
      0 => 'templates/noticiaList.tpl',
      1 => 1317836947,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8127408224e8c9801ae72c2-75545416',
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
	<img src="images/up.gif" width="32" height="32" /></a>
</td>
<table border="0" >
	<th bgcolor="#d1d1d1">id     </th>
	<th bgcolor="#d1d1d1">Titulo</th>
	<th bgcolor="#d1d1d1">Texto</th>
	<?php  $_smarty_tpl->tpl_vars["entry"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["entry"]->key => $_smarty_tpl->tpl_vars["entry"]->value){
?>
    <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#dedede,#eeeeee",'advance'=>false),$_smarty_tpl);?>
">
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['id']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['titulo']);?>

		</td>        
		<td>
			<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['texto']);?>

		</td>        
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=edit&id=<?php echo $_smarty_tpl->getVariable('entry')->value['id'];?>
&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
"  >
			<img src="images/edit.png" width="32" height="32" /></a>
		</td>
        <td><a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=delete&id=<?php echo $_smarty_tpl->getVariable('entry')->value['id'];?>
&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
			<img src="images/delete.jpg" width="32" height="32" /></a>
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
?action=goFirst&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
				<img src="images/first.gif" />
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goPrev&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
				<img src="images/prev.gif" />
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goNext&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
				<img src="images/next.gif" />
			</a>
		</td>
		<td>
			<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=goLast&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
">
				<img src="images/last.gif" />
			</a>
		</td>
	</tr>
</table>
<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?view=noticia&action=add&masterId=<?php echo $_smarty_tpl->getVariable('masterId')->value;?>
"><img src="images/add.png" width="32" height="32" /></a>

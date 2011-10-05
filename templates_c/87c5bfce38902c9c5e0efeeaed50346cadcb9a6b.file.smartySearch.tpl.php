<?php /* Smarty version Smarty-3.0.7, created on 2011-10-05 20:58:24
         compiled from "smartySearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13255910054e8ca8d0824d51-45326656%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87c5bfce38902c9c5e0efeeaed50346cadcb9a6b' => 
    array (
      0 => 'smartySearch.tpl',
      1 => 1317840372,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13255910054e8ca8d0824d51-45326656',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include 'smarty/plugins/modifier.truncate.php';
if (!is_callable('smarty_function_html_options')) include 'smarty/plugins/function.html_options.php';
?><select name="alumno">
	<option value='null'>-- none --</option>
	<?php echo smarty_function_html_options(array('options'=>smarty_modifier_truncate($_smarty_tpl->getVariable('alumnos')->value,20),'selected'=>1),$_smarty_tpl);?>

</select

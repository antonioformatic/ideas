<?php /* Smarty version Smarty-3.0.7, created on 2011-10-07 18:23:25
         compiled from "templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18804829504e8f277d799e00-49439440%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be439f82a4dbec61746f62a0df07c19a7eecd966' => 
    array (
      0 => 'templates/header.tpl',
      1 => 1318004604,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18804829504e8f277d799e00-49439440',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<link rel="stylesheet" href="css/jquery.ui.all.css">
	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	<style>
		.ui-autocomplete-loading {
			background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;
		}
	</style>
	<script>
		$(function() {
			$(".lookup").each(function(){
				var comp = $(this); 
				var url = "lib/Search.php"
					+ "?database="   + comp.attr('database')
					+ "&table="      + comp.attr('table')
					+ "&fieldSearch="+ comp.attr('fieldSearch')
					+ "&fieldRet="   + comp.attr('fieldRet')
					;
				comp.autocomplete({
					source : url, 
					minLength : 0,
					focus : function(event, ui) {
						comp.val(ui.item.ret);
						return false;
					},
					select: function(event, ui){
						comp.val(ui.item.ret);
						return false;
					}
				});
			});
		});
	</script>
</head>
<body>
<div style="text-align:center;">
<h1>PROGRAMA DE CONTROL GENERAL DE LA SITUACION </h1>
</div>
<hr>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

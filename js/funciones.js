/*
	Confusión: 
		los campos externaldField llaman a Lookup.php
		los campos lookup llaman a Search.php
		CAMBIAR ESTO!!!!!!!!!!!
*/
function reloadLookups(){
	$(".externalField").each(function(){
		x = $(this); 
		$.ajax({
			url :"lib/Lookup.php",
			data: {
				database:    x.attr('database'),
				table:       x.attr('table'),
				fieldRet:    x.attr('fieldRet'),
				value_id:   $("#"+x.attr('value_id')).val()
			},
			success: function(data) {
				x.text(data);
			}
		});
	});
}
$(function() {
	$(".date").each(function(){
		$(this).datepicker({dateFormat:'yy/mm/dd'});
	});
	$(".lookup").each(function(){
		var comp = $(this); 
		var url = "lib/Search.php"
			+ "?database="   + comp.attr('database')
			+ "&table="      + comp.attr('table')
			+ "&fieldSearch="+ comp.attr('fieldSearch')
			+ "&fieldRet="   + comp.attr('fieldRet')
		;
		comp.change(function (){
			reloadLookups();	
		});
		comp.autocomplete({
			source : url, 
			minLength : 0,
			focus : function(event, ui) {
				comp.val(ui.item.ret);
				return false;
			},
			select: function(event, ui){
				comp.val(ui.item.ret);
				reloadLookups();
				return false;
			}
		});
	});
	reloadLookups();	
});

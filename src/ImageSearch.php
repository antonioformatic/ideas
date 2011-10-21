-----------------------------
En el script de la página:
	$("#imageSearch").autocomplete("images.php", {
		width: 320,
		max: 4,
		highlight: false,
		scroll: true,
		scrollHeight: 300,
		formatItem: function(data, i, n, value) {
			return "<img src='images/" + value + "'/> " + value.split(".")[0];
		},
		formatResult: function(data, value) {
			return value.split(".")[0];
		}
	});

--------------------------
En el fichero search.php:
<?php
$term = $_REQUEST['q'];
$images = array_slice(scandir("images"), 2);
foreach($images as $value) {
	if( strpos(strtolower($value), $term) === 0 ) {
		echo $value . "\n";
	}
}
?>


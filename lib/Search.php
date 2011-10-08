<?php
/*
Busca en una tabla un valor dado y devuelve un array 
en formato json con los registros en los que el campo
a buscar contiene el valor dado. Para cada registro 
encontrado, devuelve el campo a buscar como "label" y
el campo a devolver como "ret".
*/
function array_to_json($array) {

	if (!is_array($array)) {
		return false;
	}

	$associative = count(array_diff(array_keys($array), array_keys(array_keys($array))));
	if ($associative) {

		$construct = array();
		foreach ($array as $key => $value) {

			// We first copy each key/value pair into a staging array,
			// formatting each key and value properly as we go.

			// Format the key:
			if (is_numeric($key)) {
				$key = "key_$key";
			}
			$key = "\"" . addslashes($key) . "\"";

			// Format the value:
			if (is_array($value)) {
				$value = array_to_json($value);
			} else if (!is_numeric($value) || is_string($value)) {
				$value = "\"" . addslashes($value) . "\"";
			}

			// Add to staging array:
			$construct[] = "$key: $value";
		}

		// Then we collapse the staging array into the JSON form:
		$result = "{ " . implode(", ", $construct) . " }";

	} else {// If the array is a vector (not associative):

		$construct = array();
		foreach ($array as $value) {

			// Format the value:
			if (is_array($value)) {
				$value = array_to_json($value);
			} else if (!is_numeric($value) || is_string($value)) {
				$value = "'" . addslashes($value) . "'";
			}

			// Add to staging array:
			$construct[] = $value;
		}

		// Then we collapse the staging array into the JSON form:
		$result = "[ " . implode(", ", $construct) . " ]";
	}

	return $result;
}


$hostname = "localhost";
$username = "root";
$password = "secreto";
$connection = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 

$database = $_GET['database'];
$table = $_GET['table'];
$fieldSearch = explode(",",$_GET['fieldSearch']);
$valueSearch = '%';
$valueSearch.= $_GET['term'];
$valueSearch.='%';
$fieldRet = $_GET['fieldRet'];

mysql_select_db($database, $connection);
$query_conexion = "SELECT * FROM ". $table . "  WHERE "; 
foreach($fieldSearch as $field){
	$query_conexion .= $field . " LIKE '" . $valueSearch ."' OR ";
}
$query_conexion=substr($query_conexion,0, -3);//quitamos el último OR 
$conexion = mysql_query($query_conexion, $connection) or die(mysql_error());
$row = mysql_fetch_assoc($conexion);

$result = array();

do {
	$label= '';
	foreach($fieldSearch as $field){
		$label.= $row[$field] . ", ";	
	}
	$label=substr($label,0, -2);//quitamos la última coma 
	array_push(
		$result, 
		array(
			"ret"   => $row[$fieldRet], 
			"label" => $label
		)
	);
} while ($row= mysql_fetch_assoc($conexion));
echo array_to_json($result);
mysql_free_result($conexion);
?>

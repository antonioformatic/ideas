<?php
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_Photos_UserQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_PhotoQuery');
Zend_Loader::loadClass('Zend_Gdata_App_Extension_Category');

require_once(LIB_DIR .'MasterTable.php');
class Foto extends MasterTable{
	function __construct() {
		$this->table        = 'foto';
		$this->fields= array(
			'nombre'              ,
			'image'          
		);
		$this->level = 0;
		parent::__construct();
		mostrarAlbum("gravitylandou@gmail.com", "gravitylandourense", "Carreras");
	}
	function getTable(){
		$ret = '{' ;
		if($_SESSION['nivel_usuario'] > 5){
			$ret .= ' "add"      : "true"';
			$ret .= ',"edit"     : "true"';
			$ret .= ',"delete"   : "true"';
		}else{
			$ret .= ' "add"      : "false"';
			$ret .= ',"edit"     : "false"';
			$ret .= ',"delete"   : "false"';
		}
		$ret .= ',
			"colModel" : [
				{"type":"text", "display": "Nombre",    "name" : "nombre",         "width" : 150 },
				{"type":"image","display": "Foto",      "name" : "image",     "width" : 250 }
			]
		}';
		return $ret;
	}
	function getForm(){
		return '{
			"colModel" : [
				{"type":"text", "display": "Nombre",   "value" : "nombre",   "width" : 150 },
				{
					"type"       :"image"      , 
					"display"    :"Foto"       ,   
					"value"      :"image"      ,
					"width"      : 25             
				} 
			]
		}';
	}

	function isValidForm($formvars) {
		$this->errors = null;
		return empty($this->errors);
	}
}
?>
<?php
function mostrarAlbum($user, $pass, $albumId) {
	$service = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
	$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
    $photos = new Zend_Gdata_Photos($client);

    $query = new Zend_Gdata_Photos_AlbumQuery();
    $query->setUser($user);
    $query->setAlbumName($albumId);

    $albumFeed = $photos->getAlbumFeed($query);
    foreach ($albumFeed as $entry) {
        if ($entry instanceof Zend_Gdata_Photos_PhotoEntry) {
            $thumb = $entry->getMediaGroup()->getThumbnail();
            echo "<img class='thumb' src='" . $thumb[1]->getUrl() . "' />";
        }
    }
}
?>

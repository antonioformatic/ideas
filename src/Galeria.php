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
class Galeria extends MasterTable{
	function __construct() {
		$this->level = 10;
		parent::__construct();
	}
	function dispatch($controller){
		if(isset($_REQUEST['action'])){
			$this->action= $_REQUEST['action']; 
		}
		$this->tpl = $controller;
		switch($this->action){
		case 'foto':
			$this->tpl->assign('foto', 
					$this->getFoto(
						"gravitylandou@gmail.com", 
						"gravitylandourense", 
						"Carreras",
						$_REQUEST['fotoId']
					));
			$this->tpl->display('foto.tpl');
			break;
		default:
			$this->tpl->assign('fotos', 
					$this->getAlbum(
						"gravitylandou@gmail.com", 
						"gravitylandourense", 
						"Carreras"
					));
			$this->tpl->display('galeria.tpl');
			break;
		}
	}
	function getLevel(){
		return $this->level;
	}
	function getAlbum($user, $pass, $albumName) {
		$service = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
		$photos = new Zend_Gdata_Photos($client);

		$query = new Zend_Gdata_Photos_AlbumQuery();
		$query->setUser($user);
		$query->setAlbumName($albumName);

		$albumFeed = $photos->getAlbumFeed($query);
		$ret = array();
		foreach ($albumFeed as $entry) {
			if ($entry instanceof Zend_Gdata_Photos_PhotoEntry) {
				$thumb = $entry->getMediaGroup()->getThumbnail();
				$ret[]= array("url"=> $thumb[1]->getUrl(),"id"=> $entry->getGphotoId()); 
			}
		}
		return $ret;
	}
	function getFoto($user, $pass, $albumName, $photoId) {
		$service = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
		$photos = new Zend_Gdata_Photos($client);
		$query = new Zend_Gdata_Photos_PhotoQuery();
		$query->setUser($user);
		$query->setAlbumName($albumName);
		$query->setPhotoId($photoId);
		$query = $query->getQueryUrl();

		$photoFeed = $photos->getPhotoFeed($query);
		$thumbs = $photoFeed->getMediaGroup()->getContent();
		return $thumbs[0]->getUrl();
	}
}
?>

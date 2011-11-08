<?php
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_HttpClient');
Zend_Loader::loadClass('Zend_Gdata_Calendar');
Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_Photos_UserQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_PhotoQuery');
Zend_Loader::loadClass('Zend_Gdata_App_Extension_Category');
class CarreraConInscripciones extends MasterTable{
	function __construct() {
		$this->table        = 'carrera';
		$this->detailView   = 'inscripcion';
		$this->fields= array(
				'nombre', 
				'fecha', 
				'lugar', 
				'distancia', 
				'mapa' 
		);
		$this->level = 10;
		parent::__construct();
	}
	function getTable(){
		return '{
			"add"      : "true",
			"edit"     : "true",
			"delete"   : "true",
			"colModel" : [
				{"type":"text", "display": "Id",       "name" : "id",       "width" : 5  },
				{"type":"text", "display": "Nombre",   "name" : "nombre",   "width" : 50 },
				{"type":"text", "display": "Fecha",    "name" : "fecha",    "width" : 25 },
				{"type":"text", "display": "Lugar",    "name" : "lugar",    "width" : 50 },
				{"type":"text", "display": "Distancia","name" : "distancia","width" : 5  }, 
				{"type":"text", "display": "Mapa",     "name" : "mapa",     "width" : 50 } 
			]
		}';
	}
	function getForm(){
		return '{
			"colModel" : [
				{"type":"text", "display": "Nombre",   "value" : "nombre",   "width" : 150 },
				{"type":"date", "display": "Fecha",    "value" : "fecha",    "width" : 250 },
				{"type":"mapa", "display": "Lugar",    "value" : "lugar",    "width" : 150 },
				{"type":"text", "display": "Distancia","value" : "distancia","width" : 150 },
				{"type":"text", "display": "Mapa",     "value" : "mapa",     "width" : 150 } 
			]
		}';
	}

	function isValidForm($formvars) {
		$this->errors = null;
		return true;
	}
	function onAddEntry($data){
		createEvent(
			getClientLoginHttpClient("gravitylandou@gmail.com","gravitylandourense"),
			$data['nombre']    ,	
			"Carrera normal"   ,	
			$data['lugar']     ,	
			$data['fecha']     ,	
			'00:00'            ,
			$data['fecha']     ,	
			'23:59'            , 
			'+01'
		);
	}
	/**
	 * Creates an event on the authenticated user's default calendar with the
	 * specified event details.
	 *
	 * @param  Zend_Http_Client $client    The authenticated client object
	 * @param  string           $title     The event title
	 * @param  string           $desc      The detailed description of the event
	 * @param  string           $where
	 * @param  string           $startDate The start date of the event in YYYY-MM-DD format
	 * @param  string           $startTime The start time of the event in HH:MM 24hr format
	 * @param  string           $endDate   The end date of the event in YYYY-MM-DD format
	 * @param  string           $endTime   The end time of the event in HH:MM 24hr format
	 * @param  string           $tzOffset  The offset from GMT/UTC in [+-]DD format (eg -08)
	 * @return string The ID URL for the event.
	 */
	function createEvent ($client, $title = 'Tennis with Beth',
			$desc='Meet for a quick lesson', $where = 'On the courts',
			$startDate = '2008-01-20', $startTime = '10:00',
			$endDate = '2008-01-20', $endTime = '11:00', $tzOffset = '-08') {

		$gc = new Zend_Gdata_Calendar($client);
		$newEntry = $gc->newEventEntry();
		$newEntry->title = $gc->newTitle(trim($title));
		$newEntry->where  = array($gc->newWhere($where));

		$newEntry->content = $gc->newContent($desc);
		$newEntry->content->type = 'text';

		$when = $gc->newWhen();
		$when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
		$when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
		$newEntry->when = array($when);

		$createdEntry = $gc->insertEvent($newEntry);
		return $createdEntry->id->text;
	}
	/**
	 * Returns a HTTP client object with the appropriate headers for communicating
	 * with Google using the ClientLogin credentials supplied.
	 *
	 * @param  string $user The username, in e-mail address format, to authenticate
	 * @param  string $pass The password for the user specified
	 * @return Zend_Http_Client
	 */
	function getClientLoginHttpClient($user, $pass) {
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
		return $client;
	}
}
?>

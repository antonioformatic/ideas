<?php
class Table{
	var $pdo = null;
	var $tpl = null;
	var $error = null;

	var $dbtype = null;
	var $dbname = null;
	var $dbhost = null;
	var $dbuser = null;
	var $dbpass = null;

	var $fromRec = 0;
	var $recsByPage = 5;
	var $formTemplate = '';
	var $listTemplate = '';
	var $templateData = array();
	var $table = '';
	var $id = -1;
	var $masterId = -1;
	var $action = '';
	var $fields = array();

	function __construct() {
		try {
			$dsn = "{$this->dbtype}:host={$this->dbhost};dbname={$this->dbname}";
			$this->pdo =  new PDO($dsn,$this->dbuser,$this->dbpass);
		} catch (PDOException $e) {
			print "Error de conexion!: " . $e->getMessage();
			die();
		}	
		session_start();
	}

	function dispatch($controller){
		$this->tpl = $controller;
		if(isset($_SESSION['id'])){
			$this->id = $_SESSION['id'];
		}
		if(isset($_REQUEST['id'])){
			$this->id = $_REQUEST['id'];
			$_SESSION['id'] = $this->id;
		}
		if(isset($_SESSION['masterId'])){
			$this->masterId = $_SESSION['masterId'];
		}
		if(isset($_REQUEST['masterId'])){
			$this->masterId = $_REQUEST['masterId'];
			$_SESSION['masterId'] = $this->masterId;
		}
		if(isset($_REQUEST['action'])){
			$this->action= $_REQUEST['action']; 
		}
		switch($this->action) {
		case 'goFirst':
			$this->goFirst();
			$this->displayList($this->getRecords());        
			break;
		case 'goNext':
			$this->goNext();
			$this->displayList($this->getRecords());        
			break;
		case 'goPrev':
			$this->goPrev();
			$this->displayList($this->getRecords());        
			break;
		case 'goLast':
			$this->goLast();
			$this->displayList($this->getRecords());        
			break;
		case 'delete':
			$this->delete($id);
			$this->displayList($this->getRecords());        
			break;
		case 'edit':
			$this->displayForm($this->getRecord());
			break;
		case 'add':
			$this->displayForm();
			break;
		case 'submit':
			//$this->mungeFormData($_POST);
			if($this->isValidForm($_POST)) {
				if($_POST['db_action']== 'update'){
					$this->updateEntry($_POST);
				}else{
					$this->addEntry($_POST);
				}
				$this->displayList($this->getRecords());
			} else {
				$this->displayForm($_POST);
			}
			break;
		case 'view':
		default:
			$this->displayList($this->getRecords());        
			break;   
		}
	}
	function goFirst(){
		$this->fromRec = 0;
		$_SESSION['fromRec'] = $this->fromRec;
	}
	function goPrev(){
		$this->fromRec =  $_SESSION['fromRec'];
		$this->fromRec -= $this->recsByPage;
		if($this->fromRec < 0){
			$this->fromRec = 0;
		}
		$_SESSION['fromRec'] = $this->fromRec;
	}
	function goNext(){
		$this->fromRec =  $_SESSION['fromRec'];
		if($this->fromRec < $this->getNumRecords() - $this->recsByPage){
			$this->fromRec += $this->recsByPage;
		}
		$_SESSION['fromRec'] = $this->fromRec;
	}
	function goLast(){
		$this->fromRec = $this->getNumRecords() - $this->recsByPage;
		if($this->fromRec < 0){
			$this->fromRec = 0;
		}
		$_SESSION['fromRec'] = $this->fromRec;
	}
	function getNumRecords(){
		$n = 0;
		try {
			$t = 'select count(*) from ' . $this->table ;
			$sql = $this->pdo->query($t);
			$n = $sql->fetch(PDO::FETCH_BOTH);
		}catch(PDOException $e){
			print "Error!: " . $e->getMessage();
			return false;
		}	
		return $n[0];
	}
	function getNumRelatedRecords(){
		$n = 0;
		try {
			$t = 'select count(*) from ' . $this->table ;
			$t .= ' where '. $this->externalIndex . ' = ';
			$t .= $this->masterId;
			$sql = $this->pdo->query($t);
			$n = $sql->fetch(PDO::FETCH_BOTH);
		}catch(PDOException $e){
			print "Error!: " . $e->getMessage();
			return false;
		}	
		return $n[0];
	}
	function displayForm($formvars = array()) {
		if(empty($formvars)){
			$this->tpl->assign('formVars',null);
			$this->tpl->assign('masterId',$this->masterId);
			$this->tpl->assign('db_action','add');
		}else{
			// assign the form vars
			$this->tpl->assign('formVars',$formvars);
			$this->tpl->assign('masterId',$this->masterId);
			$this->tpl->assign('id',$this->id);
			$this->tpl->assign('db_action','update');
		}

		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('data', $this->templateData[$this->formTemplate]);
		$this->tpl->display($this->formTemplate);
	}
	function displayList($records = array()) {
		$this->tpl->assign('records', $records);
		$this->tpl->assign('masterId', $this->masterId);
		$this->tpl->assign('id',$this->id);
		$this->tpl->assign('data', $this->templateData[$this->listTemplate]);
		$this->tpl->display($this->listTemplate);        
	}
	function delete(){
		try {
			$rh = $this->pdo->prepare("delete from ". $this->table . " where id = ?");
			$rh->execute(array($this->id));
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		}	
		return true;
	}
	function updateEntry($formvars) {        
		try {

			$q = "update " . $this->table . " set ";
			foreach($this->fields as $field){
				$q.= $field . ' =  ?,';
			}
			$q=substr($q,0, -1);//quitamos la última coma
			$q .= ' where id = ?';
			$rh = $this->pdo->prepare($q);
			$v = array();
			foreach($this->fields as $field){
				if(is_array($formvars[$field])){
					$v[] = implode(",", $formvars[$field]);
				}else{
					$v[] = $formvars[$field];
				}
			}
			$v[] = $this->id;
			$rh->execute($v);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		}	
		return true;
	}
	function addEntry($formvars) {        
		try {
			$q = "insert into " . $this->table . " (";
			foreach($this->fields as $field){
				$q.= $field . ',';
			}
			$q=substr($q,0, -1);//quitamos la última coma
			$q .= ') values (';
			foreach($this->fields as $field){
				$q.= '?,';
			}
			$q=substr($q,0, -1);//quitamos la última coma
			$q .= ')';
			$rh = $this->pdo->prepare($q);
			$v = array();
			foreach($this->fields as $field){
				if(is_array($formvars[$field])){
					$v[] = implode(",", $formvars[$field]);
				}else{
					$v[] = $formvars[$field];
				}
			}
			$rh->execute($v);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		}	
		return true;
	}
	function mungeFormData(&$formvars) {
		foreach($this->fields as $field){
			$formvars[$field] = trim($formvars[$field]);
		}
	}
	function getRecords($id = -1){
		if($id == -1){
			if(isset($_SESSION['fromRec'])){
				$this->fromRec =  $_SESSION['fromRec'];
			}
			try {
				$sql = 'select * from ' . $this->table .  ' LIMIT ' 
					. $this->fromRec 
					. ','
					.$this->recsByPage;
				$rows = array();
				foreach ($this->pdo->query($sql) as $row) {
					$rows[] = $row;
				}
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage();
				return false;
			} 	
			return $rows;   
		}else{
			try {
				$rh = $this->pdo->prepare("select * from " . $this->table . " where id = ?");
				$rh->execute(array($id));
				$row = $rh->fetch(PDO::FETCH_BOTH);
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage();
				return false;
			} 	
			return $row;   

		}

	}
	function getRecord(){
		try {
			$rh = $this->pdo->prepare("select * from " . $this->table . " where id = ?");
			$rh->execute(array($this->id));
			$row = $rh->fetch(PDO::FETCH_BOTH);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage();
			return false;
		} 	
		return $row;   
	}
}
?>

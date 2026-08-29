<?php
require_once __DIR__.'/manager.php';
require_once __DIR__.'/../models/accolade.php';

class AccoladeManager extends Manager{
	
	protected function getPrimaryKeys(){
		return ["id"];
	}
	protected function getColumns(){
		return ["name", "type", "rank", "rgb", "notes"];
	}
	protected function getUpdateColumns(){
	    return ["name", "type", "rank", "srm", "notes"];
	}
	protected function getInsertColumns(){return $this->getUpdateColumns();}
	protected function getTableName(){
		return "accolades";
	}
	protected function getViewName(){
	    return "vwAccolades";
	}
	protected function getDBObject(){
		return new Accolade();
	}	
	
	function GetByName($name){
	    global $mysqli;
	    $sql="SELECT * FROM ".$this->getTableName()." WHERE name = '".$mysqli->real_escape_string($name)."'";
		return $this->executeQueryWithSingleResult($sql);
	}
	function GetAllForBeer($id){
		$sql="SELECT * FROM ".$this->getTableName()." t left join beer".ucwords($this->getTableName())." tb on (t.id = tb.".$this->getTableName()."Id) WHERE tb.beerId = ".(int)$id;
		return $this->executeQueryWithResults($sql);
	}
	function GetDistinctForBeer($id){
	    $sql="SELECT Distinct t.* FROM ".$this->getTableName()." t left join beer".ucwords($this->getTableName())." tb on (t.id = tb.".$this->getTableName()."Id) WHERE tb.beerId = ".(int)$id;
	    return $this->executeQueryWithResults($sql);
	}
}
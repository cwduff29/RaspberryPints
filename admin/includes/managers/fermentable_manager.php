<?php
require_once __DIR__.'/manager.php';
require_once __DIR__.'/../models/fermentable.php';

class FermentableManager extends Manager{
	
	protected function getPrimaryKeys(){
		return ["id"];
	}
	protected function getColumns(){
		return ["name", "type", "srm", "notes"];
	}
	protected function getUpdateColumns(){
	    return ["name", "type", "srm", "notes"];
	}
	protected function getInsertColumns(){return $this->getUpdateColumns();}
	protected function getTableName(){
		return "fermentables";
	}
	protected function getViewName(){
	    return "vwFermentables";
	}
	protected function getDBObject(){
		return new Fermentable();
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
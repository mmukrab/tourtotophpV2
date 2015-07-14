<?php
require_once('entity.class.php');
class user extends entity
{
public function __construct($id,$conn)
{
	$this->tablename = 'users';
	parent::__construct($id,$conn);
}

public function getUsernaam()
{
	return $this->usernaam;
}
public function getPassword()
{
	return $this->password;
}
public function findByNaam($usernaam)
{
	$this->_findby('usernaam',$usernaam);
}
protected function _setProperties($data)
	{
		$this->id = $data->id;
		$this->usernaam = $data->usernaam;
		$this->password = $data->password;	
	}
protected function _iniProperties()
	{
		$this->id = 0;
		$this->usernaam = "";
		$this->password = "";	
	}
protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (usernaam,password) VALUES ('".$this->usernaam."', '".$this->password."')";
		return $this->conn->doInsert($qry);
	}
protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET usernaam='".$this->usernaam."',password ='".$this->password." WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}	
}
?>
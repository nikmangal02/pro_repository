<?php


class db
{
public $hostname="localhost";
public $username="root";
public $password="";

public $con;
public function __construct()
{
	$this->connect();
}

private function connect()
{
$this->con=new PDO("mysql:host=$this->hostname;dbname=cart",$this->username,$this->password);
}


public function insert($sq)
{
	return $result = $this->con->query($sq);
	
	
}
public function lis($sql)
{
	return $result=$this->con->query($sql);
}

public function stre($sql)
{
	return $result=$this->con->query($sql);
}
public function item($sql)
{
	return $res=$this->con->query($sql);
}
	}
?>
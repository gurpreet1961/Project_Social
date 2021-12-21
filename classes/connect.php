<?php

class Database
{

	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $db = "socialsite_db";
	// private $host = "	sql106.epizy.com";
	// private $username = "epiz_28737898";
	// private $password = "Y8fQsGer15fUT";
	// private $db = "epiz_28737898_socialsite_db";

	function connect()
	{
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);
		return $connection;
	}
	function read($query)
	{

		$conn = $this->connect();
		$result = mysqli_query($conn,$query);
		if(!$result)
		{
			return false;

		}
		else
		{
			$data = false;
			while ($row = mysqli_fetch_assoc($result)) 
			{
				
				$data[] =  $row;
				
			}

			return $data;

		}

	}
	function save($query)
	{
		$conn = $this->connect();
		$result = mysqli_query($conn,$query);

		if(!$result)
		{
			return false;

		}
		else
		{
			return true;
		}
	}
}


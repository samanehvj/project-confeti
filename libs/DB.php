<?php

Class DB{

	var $debug = true;

	public function connect(){
		$dbDetails = parse_ini_file("../db.ini"); 
		
		return mysqli_connect($dbDetails["host"], $dbDetails["user"], $dbDetails["pass"], $dbDetails["dbname"]);
	}

	static public function query($sql){

		$oDB = new DB();

		if($oDB->debug)
		{
			$oDB->debug($sql);
		}

		$results = mysqli_query($oDB->connect(), $sql);

		if($results)
		{
			$data = null;
			while($row = mysqli_fetch_assoc($results))
			{
				$data[] = $row;
			}

			return $data;
		}
	}

	/**
	 * Author: Samaneh 
	 * Description: This method accept a sql insert query 
	 * and will return true if adding to database successfully
	 * or will return false if somthing goes wrong
	 */
	public static function insert($sql) {
		
		$oDB = new DB();

		if($oDB->debug)
		{
			$oDB->debug($sql);
		}

		// if insert successfully, it will return true otherwise return false.
		$con = $oDB->connect();
		return mysqli_query($con, $sql);
	}

	public function debug($sql)
	{
		//echo "<script>console.log('$sql')</script>";
	}
}
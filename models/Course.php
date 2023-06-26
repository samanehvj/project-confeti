<?php 

Class Course {

	public function __construct($data)
	{
		$this->id = $data["id"];
		$this->courseName = $data["courseName"];
		$this->instructor = $data["instructor"];
	}	
}

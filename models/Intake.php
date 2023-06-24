<?php 

Class Intake {

	public function __construct($data)
	{
		$this->id = $data["id"];
		$this->term = $data["term"];
		$this->intakeName = $data["intakeName"];
	}
}

<?php 

Class Assignment {

	public function __construct($data)
	{
		$this->id = $data["id"];
		$this->name = $data["name"];
		$this->description = $data["description"];
		$this->publish_date = $data["publish_date"];
		$this->due_date = $data["due_date"];
		$this->resources = $data["resources"];
		$this->weight = $data["weight"];
		$this->status = $data["status"];
		$this->intake_term_courses_teachers_id = $data["intake_term_courses_teachers_id"];
		$this->hide = $data["hide"];
	}	
}
?>
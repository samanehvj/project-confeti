<?php 

Class Courses {

	public function __construct($data)
	{
		$this->id = $data["id"];//intake_term_courses_teachers.id
		$this->course_id = $data["course_id"];
		$this->teacher_id = $data["teacher_id"];
		$this->courseName = $data["courseName"];
		$this->intake_id = $data["intake_id"];
		//$this->userId = $userData["userId"];//this one doesn't work
		$this->name = $data["name"];
		$this->username = $data["username"];
		$this->instructor = $data["instructor"];
	}
	
	/* 
	this method receives an $id parameter which is the userID of which we want courses for
	this method getsCourses for a specific userID 
	
	returns: array of course objects. */

	public static function getCourses($id)
	{
		$courses = DB::query("SELECT  intake_term_courses_teachers.id, intake_term_courses_teachers.course_id,  intake_term_courses_teachers.teacher_id, courses.name AS courseName, students.intake_id, users.id AS userId, users.name, users.username, teachers.name AS instructor
			FROM intake_term_courses_teachers
			LEFT JOIN courses
			ON intake_term_courses_teachers.course_id = courses.id
			LEFT JOIN students
			ON intake_term_courses_teachers.intake_term_id = students.intake_id
			LEFT JOIN users 
			ON students.user_id = users.id
			LEFT JOIN teachers
			ON intake_term_courses_teachers.teacher_id = teachers.id
			WHERE users.id =".$id); 

        // acting as a factory
		$courseArray = array(); // empty array to avoid errors when no assignments were found
		foreach($courses as $course)
		{
			// create an instance / object for this SPECIFIC 
			$courseArray[] = new Courses($course); // put this  object onto the array
		}

		// return the list of objects
		return $courseArray;
	}

	// teacher gets teaching courses
	public static function getTeachCourses()
	{
		$courses = DB::query("SELECT  intake_term_courses_teachers.id, intake_term_courses_teachers.course_id,  intake_term_courses_teachers.teacher_id, courses.name AS courseName, students.intake_id, users.id AS userId, users.name, users.username, teachers.name AS instructor
		FROM intake_term_courses_teachers
		LEFT JOIN courses
		ON intake_term_courses_teachers.course_id = courses.id
		LEFT JOIN students
		ON intake_term_courses_teachers.intake_term_id = students.intake_id
		LEFT JOIN users 
		ON students.user_id = users.id
		LEFT JOIN teachers
		ON intake_term_courses_teachers.teacher_id = teachers.id
		where teacher_id =1"); 

        // acting as a factory
		$courseArray = array(); // empty array to avoid errors when no assignments were found
		foreach($courses as $course)
		{
			// create an instance / object for this SPECIFIC 
			$courseArray[] = new Courses($course); // put this  object onto the array
		}

		// return the list of objects
		return $courseArray;
	}
}

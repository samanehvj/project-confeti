<?php 

Class Student {

	//get the Web18 term 3
	public static function getIntake($id)
	{
		$arrIntake = DB::query("SELECT intakes.name AS intakeName, terms.name AS term, users.id AS id
			FROM students
			LEFT JOIN intakes
			ON students.intake_id = intakes.id
			LEFT JOIN intake_terms
			ON students.intake_id = intake_terms.intake_id
			LEFT JOIN terms
			on intake_terms.term_id = terms.id
			LEFT JOIN users
			ON students.user_id = users.id
			WHERE users.id=".$id);

		//print_r($arrIntake);

		//$IntakesArray = array(); // empty array to avoid errors

        foreach($arrIntake as $intake)
       {
            // create an instance / object for this SPECIFIC intake
            $IntakesArray = new Intake($intake); // I only get 1 result
      	}
       
       print_r($IntakesArray);

        // return the list of objects
        return $IntakesArray;
	}


	/**
	 * Author: Samaneh 
	 * Description: This method accept student ID and student filename 
	 * 	and student assignment description
	 * 	and assignment ID from student submitted form 
	 * 	and save them in to the student_assignments table
	 */
	public static function submitAssignment($studentId, $assignmentForm) 
	{
		//Student description or shared link for the assignment
		$description = $assignmentForm['description'] ?: '';
		//Student uploaded file name and address 
		$fileName = $assignmentForm['filename'] ?: '';
		//ID of the specefic assignment which is submited by student
		$assignmentId = $assignmentForm['assignmentId'] ?: '';

		//If the assignment id is empty or the student id is empty no record add to database
		if(empty($assignmentId) || empty($studentId)) {
			echo "Student ID or Assignment Id should not be null";
			return false;
		}

		//If both file and description is empty -student sumbit empty form- no record add to database
		if( empty($fileName) && empty($description)) {
			echo "Submited form should not be empty, please fill in at least one of filename or description";
			return false;
		}

		$sql = "INSERT INTO student_assignments
		(student_id, assignment_id, filename, description) 
		VALUES 
		('".$studentId."', '".$assignmentId."', '".$fileName."', '".$description."')";

		//If every thing was ok, try to insert in to database
		return DB::insert($sql);
	}
}
?>
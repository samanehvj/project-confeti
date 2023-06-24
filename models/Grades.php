<?php 

Class Grades {

    public function __construct($data)
	{
        $this->student_id = $data["student_id"];
        $this->assignment_id = $data["assignment_id"];
        $this->title = $data["title"];
		$this->mark = $data["mark"];
		$this->feedback = $data["feedback"];
	}

    // get a grade list of a course
	public static function getGradeList()
	{
		$grades = DB::query("SELECT student_assignments.assignment_id, assignments.name AS title,  student_assignments.student_id, student_assignments.mark, student_assignments.feedback
        FROM student_assignments
        LEFT JOIN assignments ON student_assignments.assignment_id = assignments.id"); 

        // acting as a factory
		$gradeArray = array(); // empty array to avoid errors when no assignments were found
		foreach($grades as $grade)
		{
			// create an instance / object for this SPECIFIC 
			$gradeArray[] = new Grades($grade); // put this  object onto the array
		}

		// return the list of objects
		return $gradeArray;
    }
    
    // get a grade of specific assignmnet
    public static function getGrade()
	{
		$grades  = DB::query("SELECT student_assignments.assignment_id, assignments.name AS title,  student_assignments.student_id, student_assignments.mark, student_assignments.feedback
        FROM student_assignments
        LEFT JOIN assignments ON student_assignments.assignment_id = assignments.id
        WHERE student_assignments.id = ".$_GET["aId"].""); 

        // acting as a factory
		$gradeArray = array(); // empty array to avoid errors when no assignments were found
		foreach($grades as $detail)
		{
			// create an instance / object for this SPECIFIC 
			$gradeArray[] = new Grades($detail); // put this  object onto the array
		}

		// return the list of objects
		return $gradeArray;
	}
}

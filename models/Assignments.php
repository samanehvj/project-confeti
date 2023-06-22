<?php 

Class Assignments {
	
	// get assignment list sorted by new assignment
	public static function getNewList()
	{
		$assignments = DB::query("SELECT * FROM assignments ORDER BY publish_date DESC"); // gives me potentially muliple assignments

        // acting as a factory
       $assignmentArray = array(); // empty array to avoid errors when no assignments were found

        foreach($assignments as $assignment)
        {
            // create an instance / object for this SPECIFIC assignment
            $assignmentArray[] = new Assignment($assignment); // put this assignment object onto the array
        }
       
        // return the list of assignment objects
        return $assignmentArray;
	}

	public static function getAll()
	{
		// annette: Karla, can you write a querry that gets all asssignments for the current user
		$assignments = DB::query("SELECT * FROM assignments ORDER BY publish_date DESC"); // gives me potentially muliple assignments

		// DEMO DATA /
		// $assignments =array(
		// 	 	array('id'=>123,'name'=>'New Assignments', 'description'=>'jQuery: Assignment', 'due_date'=>'10/6/20'),
		// 	 	array('id'=>321,'name'=>'New Assignments', 'description'=>'jQuery: Assignment', 'due_date'=>'10/6/20'),
		// 	 	array('id'=>123,'name'=>'New Assignments', 'description'=>'jQuery: Assignment', 'due_date'=>'10/6/20')
		// 	);

        // acting as a factory
       $assignmentArray = array(); // empty array to avoid errors when no assignments were found
        foreach($assignments as $assignment)
        {
            // create an instance / object for this SPECIFIC assignment
            $assignmentArray[] = new Assignment($assignment); // put this assignment object onto the array
        }

        // return the list of assignment objects
        return $assignmentArray;
	}

	// get upcoming assignments sortrd by due date 
	public static function upcoming()
	{
		$assignments = DB::query("SELECT * FROM assignments ORDER BY due_date"); // gives me potentially muliple assignments

		// DEMO DATA /
		// $arrAssignments = array(
		// 	array('dueMonth'=>'Oct', 'dueDate'=>'7', 'class'=>'jQuery', 'assignment'=>'Assignment'),
		// 	array('dueMonth'=>'Oct', 'dueDate'=>'9', 'class'=>'PHP', 'assignment'=>'Assignment'),
		// 	array('dueMonth'=>'Oct', 'dueDate'=>'14', 'class'=>'Project Management', 'assignment'=>'Assignment')
		//   );

        // acting as a factory
       $assignmentArray = array(); // empty array to avoid errors when no assignments were found
        foreach($assignments as $assignment)
        {
            // create an instance / object for this SPECIFIC assignment
            $assignmentArray[] = new Assignment($assignment); // put this assignment object onto the array
        }

        // return the list of assignment objects
        return $assignmentArray;
	}

	public static function getFromCourse($id)
	{
		
		$assignments = DB::query("SELECT * FROM assignments
		WHERE intake_term_courses_teachers_id =".$id); // gives me potentially muliple assignments from course id

		if($assignments == ""){
			//echo "You dont have any assignments";
			//made an object with no assignment data
			$assignmentArray = array((object) array("id" => "0", 'name' => 'no assignment', 'publish_date' => ''));
			//print_r($assignmentArray);
			return $assignmentArray;

		}else
		{
			// acting as a factory
			$assignmentArray = array(); // empty array to avoid errors when no assignments were found

			foreach($assignments as $assignment)
			{
			// create an instance / object for this SPECIFIC assignment
			$assignmentArray[] = new Assignment($assignment); // put this assignment object onto the array
			}
			//print_r($assignmentArray);

			// return the list of assignment objects
			return $assignmentArray;
		}
		
	}

	public static function getCurrent($id)
	{
		if($id == ""){
			echo "No Assignment Id given";
		} else {
			$assignments = DB::query("SELECT * FROM assignments
			WHERE id =".$id); // 1 assignment

			if($assignments == ""){
				$assignmentArray =(object) array(
					"id" => "0",
					'name' => 'No assignment Detail',
					'description' => 'you dont have an assignment',
					'publish_date' => '',
					'due_date' => '',
					'resources' => '',
					'weight' => '',
					'status' => '',
					'intake_term_courses_teachers_id' => '',
					'hide' => '');
				return $assignmentArray;
			}else

				foreach($assignments as $assignment)
				{
				// create an instance / object for this SPECIFIC assignment
				$assignmentArray = new Assignment($assignment); // put this assignment object onto the array
				}
				//print_r($assignmentArray);

				// return the list of assignment objects
				return $assignmentArray;
		}
	}
}
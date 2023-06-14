<?php

Class AssignmentsController extends Controller{

	var $content = "";

	//main student assignments
	public function mainSA(){
		$this->loadRoute("Global", "mainNav"); // load main Nav

		// if(!isset($_GET['cId']))
		// {
		// 	echo "no _GET['cId'] was provided for the mainSA. See AssignmentsController.php";
		// 	die;
		// }
		$courseId = $_GET['cId'];
		$this->loadData(Assignments::getFromCourse($courseId), "oAssignment"); 
		$this->loadView("views/assignmentsList.php", 1, "centerHTML"); 
		

		// append contents to "rightNavHTML" & "rightNavHTML" at gradeContainer.php
		$this->loadData("", "rightHTML");  // load right Navs
		$this->loadRoute("Global", "leftNav", "leftHTML"); // load left Navs

		// now all contents above are inside gradeContainer.php!

		// step 2: append the content you made at step 1 to "content" at views/main_inside.php (final view)
		$this->loadView("views/3col_contentContainer.php", 1, "content");

		$this->loadLastView("views/main_inside.php"); //final view

	}
	

	// details student assignments 
	public function detailsSA(){

		//$this->loadData(User::getCurrent(), "oCurUser"); // this now gives me a $this->oCurUser

		$this->loadData(Assignments::getCurrent($_GET['aId']), "oAssignment"); // this now gives me a $this->oAssignment

		$this->loadView("views/header.php");
		$this->loadView("views/assignmentsDetails.php");
	
		$this->loadView("views/assignmentSubmission.php"); //this will show submission form

		include("views/main.php");
	}

	//main instructor assignments
	public function mainAI(){
		$this->js("js/calendar.js");

		$this->loadRoute("Global", "mainNav"); // load main Nav

		//////// get the HTML for the $this->rightHTML, and $this->leftHTML
		$this->loadRoute("Global", "leftNav", "leftHTML"); // load left Navs
		$this->loadRoute("Global", "rightNav", "rightHTML"); // load left Navs

		$this->loadView("views/assignmentsAdd.php", 1, "centerHTML"); 

		$this->loadView("views/3col_contentContainer.php", 1, "content"); // save the results of this view, into $this->content

		$this->loadLastView("views/main_inside.php"); //final view
	}

	// details instructor assignments 
	public function detailsIA(){

		$this->loadView("views/header.php");
		$this->loadView("views/assignmentsDetails.php");

		include("views/main.php");
	}

	// add new assignment page 
	public function addAssignment() {
		$this->js("js/calendar.js");
		$this->js("js/newAssignment.js");

		$this->loadRoute("Global", "mainNav"); // load main Nav

		//////// get the HTML for the $this->rightHTML, and $this->leftHTML
		$this->loadRoute("Global", "rightNav", "rightHTML"); // load right Navs
		$this->loadRoute("Global", "leftNav", "leftHTML"); // load left Navs

		/////// get the HTML for the $this->centerHTML /////////
		$this->loadView("views/assignmentsAdd.php", 1, "assignment"); 
		$this->loadData($this->assignment, "centerHTML");

		$this->loadView("views/3col_contentContainer.php", 1, "content"); // save the results of this view, into $this->content

		$this->loadLastView("views/main_inside.php"); //final view
	}

	// add new assignment
	public function addNewAssignment(){
		if($_POST["name"] && $_POST["description"] && $_POST["due_date"] && $_POST["weight"])
		{
			$con = DB::connect();
			$sql = "INSERT INTO assignments(name, description, due_date, weight) values ('".$_POST["name"]."', '".$_POST["description"]."','".$_POST["due_date"]."','".$_POST["weight"]."')";
		
			mysqli_query($con, $sql);

			// if successed new assignment
			$this->go("assignments", "main"); 
		} else {
			// if unsucseful
			$this->go("assignments", "addAssignment"); 
		}
	}

	public function pretrip(){

		if($_SESSION["userId"]=="")
		{
			$this->go("public", "main");
		}else
		{
		$this->oCurUser = User::getCurrent();
		//echo $this->oCurUser->id;
		}
	}

	/**
	 * Author: Samaneh 
	 * Description: Get submitted form data 
	 * and try to upload and save student assignment in database
	 */
	public function submitSA(){
		//If no assignment id is defined, redirect to main
		if(!isset($_POST['assignmentId'])) {
			$this->go("assignments", "mainSA");
		}

		//If no file or no description is provided by student form should not be sumited and redirect to main
		if($_FILES['filename']['size'] == 0 && empty($_POST['description'])) {
			$this->go("assignments", "mainSA");
		}


		$target_dir = "assignments/";
		$assignmentId = $_POST['assignmentId'];
		$userId = $_SESSION['userId'];
		//create file name and directory for each userId and assignmentId to prevent name similarity
		$target_file = $target_dir . $assignmentId . "_" . $userId . "_" . basename($_FILES['filename']['name']);

		// check the extension of the uploaded file
		$ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
		//set allowed file type to be submit
		$allowFileType = array('zip', 'pdf', 'png', 'jpg', 'jpeg');

		//if the file extension is not allowed redirect to main
		if(!in_array($ext, $allowFileType)) {
			$this->go("assignments", "mainSA");
		}

		//try to move uploaded file to assignment directory and then add data to database
		if(move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
			$assignmentForm = array(
				'description' => $_POST['description'],
				'filename' => $target_file,
				'assignmentId' => $assignmentId
			);

			if(Student::submitAssignment($userId, $assignmentForm)) {
				echo "Assignment submited successfully";
				$this->go("assignments", "mainSA");
			}
		}

	}
}

// test to push on github - annette 
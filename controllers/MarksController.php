<?php

Class MarksController extends Controller{

	var $content = "";
	
	//main student marks
	public function mainSM(){
		$this->js("js/calendar.js");

		$this->loadRoute("Global", "mainNav"); // load main Nav

		
		/////// get the HTML for the $this->centerHTML /////////
		// step 1: append contents to "containerHTML" at gradeContainer.php
		$this->loadData(Grades::getGradeList(), "oGrades"); // this now gives me a $this->oAssignment
		$this->loadView("views/gradeList.php", 1, "grade"); 
		$this->loadData($this->grade, "centerHTML");

		//////// get the HTML for the $this->rightHTML, and $this->leftHTML
		// append contents to "rightNavHTML" & "rightNavHTML" at gradeContainer.php
		// call the routes and save what is produced in them into a new variable
		$this->loadRoute("Global", "rightNav", "rightHTML"); // load right Navs
		$this->loadRoute("Global", "leftNav", "leftHTML"); // load left Navs

		
		/// NOW: Above we got the variables... $this->rightHTML and $this->leftHTML and $this->centerHTML
		// step 2: append the content you made at step 1 to "content" at views/main_inside.php (final view)
		// load the view and put the html/php into the variable $this->content
		$this->loadView("views/3col_contentContainer.php", 1, "content"); // save the results of this view, into $this->content

		/// no inside here we have access to $this->content
		$this->loadLastView("views/main_inside.php"); //final view
	}
	
	// details student marks 
	public function detailsSM(){
		$this->js("js/calendar.js");

		$this->loadRoute("Global", "mainNav"); // load main Nav

		/////// get the HTML for the $this->centerHTML /////////
		$this->loadData(Grades::getGrade(), "oGrades"); // this now gives me a $this->oGrades
		$this->loadView("views/gradeDetail.php", 1, "grade"); 
		$this->loadData($this->grade, "centerHTML");

		//////// get the HTML for the $this->rightHTML, and $this->leftHTML
		// append contents to "rightNavHTML" & "rightNavHTML" at gradeContainer.php
		// call the routes and save what is produced in them into a new variable
		$this->loadRoute("Global", "rightNav", "rightHTML"); // load right Navs
		$this->loadRoute("Global", "leftNav", "leftHTML"); // load left Navs

		
		/// NOW: Above we got the variables... $this->rightHTML and $this->leftHTML and $this->centerHTML
		// load the view and put the html/php into the variable $this->content
		$this->loadView("views/3col_contentContainer.php", 1, "content"); // save the results of this view, into $this->content

		/// no inside here we have access to $this->content
		$this->loadLastView("views/main_inside.php"); //final view
	}

	
	public function test(){
		$this->loadRoute("Global", "mainNav");

		$this->loadData(Courses::getCourses(1), "oCourses"); // this now gives me a $this->oCourse
		$this->loadView("views/leftNav.php",0, "leftHTML"); //this is the final view

		$this->loadData("<h1>right side</h1>", "rightHTML");
		$this->loadData("<h1>center</h1>", "centerHTML");

		$this->loadView("views/3col_contentContainer.php", 1, "content"); 
		$this->loadLastView("views/main_inside.php"); //final view
	}

	public function test2(){
		$this->loadRoute("Global", "mainNav"); // $this->content... with whatever comes from this action

		$this->loadData(Courses::getCourses(1), "oCourses"); // this now gives me a $this->oCourse
		$this->loadView("views/leftNav.php",0, "leftHTML"); //this is the final view

		$this->loadData("<h1>right side</h1>", "rightHTML");
		$this->loadData("<h1>center</h1>", "centerHTML");

		$this->loadView("views/3col_contentContainer.php", 1, "content"); 
		$this->loadLastView("views/main_inside.php"); //final view
	}


	//main instructor marks
	public function mainIM(){
		$this->js("js/calendar.js");
		$this->loadRoute("Global", "mainNav"); // load main Nav


		include("views/main.php");
	}
	// details instructor marks 
	public function detailsIM(){
		$this->loadView("views/header.php");
		$this->loadView("views/marksDetails.php");

		include("views/main.php");
		
	}
	//this mkaes sure you are login and saves oCurUser
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
}
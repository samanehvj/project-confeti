<?php

Class GlobalController extends Controller {
	
    var $content = "";
    
    // main Nav
	public function mainNav()
	{
		$this->loadData(User::getCurrent(), "oCurUser"); // this now gives me a $this->oCurUser
		$this->loadView("views/header.php"); // load the html and append to $this->content
	}	
    
    // right Nav (calendar & upcoming event)
	public function rightNav()
	{
		// append contents to "featureArea" at rightNav.php
        $this->loadView("views/calendar.php", 1, "rightNav");

        $this->loadData(Assignments::upcoming(), "oAssignment"); // this now gives me a $this->oAssignment
		$this->loadView("views/upcoming.php", 1, "rightNav");

        $this->loadData($this->rightNav, "featureArea");

		$this->loadView("views/rightNav.php"); //this is the final view
	}
	
	// left Nav (courses)
	public function leftNav()
	{
		//is is logged in fing the id and put it in oCurUser
		if($_SESSION["userId"]=="")
		{
			$this->go("public", "main");
		}else
		{
			$this->oCurUser = User::getCurrent();
		}

		//this only works if on database user exist and is on users and on students table
		$this->loadData(Courses::getCourses($this->oCurUser->id), "oCourses"); // this now gives me a $this->oCourse
		$this->loadView("views/leftNav.php"); //this is the final view
	}	

}
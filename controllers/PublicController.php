<?php
Class PublicController extends Controller{

	var $content = "";

	public function main(){

		$this->loadView("views/login.php");
		$this->loadLastView("views/main.php");
	}

	public function doLogIn(){

		$_SESSION["userId"] = User::LogIn($_POST["username"], $_POST["password"]);

		if ($_SESSION["userId"])
		{
			$this->go("user", "main"); // if details entered exist in the db allow user to login
		} else {
			//$this->loadView("views/login.php");
			$this->go("public", "errorLogin"); // if details entered do not exist in the db redirect user back to login form with error
		}
	}

	public function errorLogin(){
		$this->loadView("views/loginError.php");
		$this->loadLastView("views/main.php");
	}
	public function doLogOut(){

		unset($_SESSION["userId"]);
		$this->go("public", "main");
	}
}
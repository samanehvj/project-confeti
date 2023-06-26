<?php 

Class User {

	public function __construct($userData)
	{
		$this->id = $userData["id"];
		$this->user_type_id = $userData["user_type_id"];
		$this->name = $userData["name"];
		$this->username = $userData["username"];
	}

	/* this function find the user by the userid we have in our session variable 
	returns: a User Object which has access to a bunch of object properties as defined in the cocontructor. */
	public static function getCurrent()
	{
		$arrUser = DB::query("SELECT * FROM users WHERE id =".$_SESSION["userId"]);

		// acting as a factory
		return new User($arrUser[0]); // factory
	}

	public static function LogIn($username, $password)
	{
		$arrUser = DB::query("SELECT * FROM users WHERE username='".$username."' and password='".$password."'");

		print_r($arrUser);

		if($arrUser)
		{
			return $arrUser[0]["id"];
			
		} else {

			return false;
		}
	}
}

?>
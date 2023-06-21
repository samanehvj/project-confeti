<?php

Class Errors{

	static public function missingMethodError($controllerName, $action){

		echo "That method wasn't found. You should add it to the $controllerName file public function $action(){}";
	}

	static public function missingControllerError($controllerName){

		echo "That controller wasn't found. You should create a $controllerName file.";
	}
}
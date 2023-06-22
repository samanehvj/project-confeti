// validation for add new assignment form
document.addEventListener("DOMContentLoaded", function() {
	var Validate = function() {
		var validate = this;
		validate.element = document.getElementById("newAssignment");

		validate.element.addEventListener("submit", function(event) {
			
			var error = false;
			var fieldGroups = document.getElementsByClassName("required"); 

			// var fields = document.querySelectorAll("input, textarea");
			// console.log(fields);
			
			for(var i=0; i<fieldGroups.length; i++)
			{	
				if(error)
				{
					event.preventDefault();
				} 
				
				var field = fieldGroups[i].querySelector("input, textarea");
				console.log(field);
				var fieldValue = field.value;

				if (fieldValue == "")
				{
					fieldGroups[i].classList.add("error");
					error = true;
				} else {
					fieldGroups[i].classList.remove("error");
				}
			} // end of for(var i=0; i<fieldGroups.length; i++)
			
		}) // end of validate.element.addEventListener("submit", function(event)

	} // end of var Validate

	new Validate();
});

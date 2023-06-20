// create a function to ensure form is filled out
var Validate = function()
{
    var validate = this;
    // create a variable that can be changed to true to overwrite event.preventDefault()
    var allowSumbit = false; // by default set to false
    validate.element = document.getElementById("formLogin");

	validate.element.addEventListener("submit", function(event)
	{
        // if the form is not filled in, prevent the default action of submitting
        if(!allowSumbit) {
            event.preventDefault();
            
            // get all the necessary elements from the php file
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            const errorElement = document.getElementById('error');
            const formLogin = document.getElementById('formLogin');

            // create a text variable for the error messages
            var text;

            // if the username field is empty or null, prompt the user to include it
            if(username.value === '' || username.value == null) {
                text = "Please provide your username";
                errorElement.innerHTML = text;
                return false;
            }

            // if the password field is empty or null, prompt the user to include it
            if(password.value === '' || password.value == null) {
                text = "Please provide your password";
                errorElement.innerHTML = text;
                return false;
            }
        }
        return allowSumbit = true; // overwrite event.preventDefault() and submit the form
	});
}
new Validate();
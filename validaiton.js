// validation.js


// To wait for the DOM content to be fully loaded before executing the code
document.addEventListener('DOMContentLoaded', function () {
    // it create a new instance of JustValidate for the form with id 'signup'
    const validation = new JustValidate('#signup', {

        // set validation rules for each form field
        rules: {
            username: {
                required: true,
                minLength: 3, // Set your desired minimum length for the username
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minLength: 8, // Set your desired minimum length for the password
            },
            password_confirmation: {
                required: true,
                equalTo: '#password', // Ensure password confirmation matches the password field
            },
        },
        // Define custom error messages for each validation rule
        messages: {
            username: {
                required: 'Please enter a username',
                minLength: 'Username must be at least 3 characters long',
            },
            email: {
                required: 'Please enter a valid email address',
                email: 'Please enter a valid email address',
            },
            password: {
                required: 'Please enter a password',
                minLength: 'Password must be at least 8 characters long',
            },
            password_confirmation: {
                required: 'Please confirm your password',
                equalTo: 'Passwords must match',
            },
        },
        // Define a function to handle form submission when all fields are valid
        submitHandler: function (form) {
            // This function is triggered when the form is submitted and all fields are valid
            form.submit();
        },
    });
});

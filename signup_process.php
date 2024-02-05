<?php
$errors = array();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include necessary files for database operations
    require_once('db_credentials.php');
    require_once('database.php');

    // Connect to the database
    $db = db_connect();

    // Validate username
    if (empty($_POST["username"])) {
        $errors[] = "Please enter a username";
    } elseif (strlen($_POST["username"]) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    } else {
        // Check for unique username in the database
        $username = mysqli_real_escape_string($db, $_POST["username"]);
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Username is already taken";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $errors[] = "Please enter a valid email address";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    } else {
        // Check for unique email in the database
        $email = mysqli_real_escape_string($db, $_POST["email"]);
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Email is already taken";
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $errors[] = "Please enter a password";
    } elseif (strlen($_POST["password"]) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    // Password confirmation
    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        $errors[] = "Passwords must match";
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Insert user into the database
        $query = "INSERT INTO user (username, email, password_hash)
                  VALUES ('$username', '$email', '$hashed_password')";
        $result = mysqli_query($db, $query);

        if ($result) {
            // Registration successful, redirect to success page
            header("Location: signup_success.php");
            exit();
        } else {
            // Database error
            $errors[] = "Error: " . mysqli_error($db);
        }
    }

    // Close the database connection
    db_disconnect($db);
}

// Include the signup.php file for rendering the form
include 'signup.php';
?>

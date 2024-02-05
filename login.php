<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title for the login page -->
    <title>Login</title>
    <!-- Linking the external stylesheet -->
    <link rel="stylesheet" media="all" href="style.css" />
</head>

<body>

    <!-- Including the header file -->
    <?php include("headerEm.php") ?>
    <?php
    // Check if the form is submitted using POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include necessary files for database operations
        require_once('db_credentials.php');
        require_once('database.php');

        // Connect to the database
        $db = db_connect();

        // Retrieve user input
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // Query the database for the user
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // User found, check the password
            $user_data = mysqli_fetch_assoc($result);
            if (password_verify($password, $user_data['password_hash'])) {
                // Password is correct, start a session and redirect
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                // Incorrect password
                $error_message = "Invalid password";
            }
        } else {
            // User not found
            $error_message = "Invalid username";
        }

        // Close the database connection
        db_disconnect($db);
    }
    ?>

    <div id="content">
        <div class="login-form">
            <!-- Heading for the login form -->
            <h1>Login</h1>

            <?php
            // Display error message if set
            if (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>

            <!-- Form for user login -->
            <form action="login.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br><br>
                <!-- Submit button for login -->
                <input type="submit" value="Login">
            </form>
        </div>
    </div>

    <!-- Including the footer file -->
    <?php include("footerEm.php") ?>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Signup</title>
    <!-- Linking the external stylesheet -->
    <link rel="stylesheet" media="all" href="style.css" />
    <!-- Including the JustValidate library for client-side form validation -->
    <script src="https://cdn.jsdelivr.net/npm/just-validate@1.5.3/dist/js/just-validate.min.js"></script>
    <!-- Including the custom validation script -->
    <script src="validation.js"></script>
</head>

<body>
    <?php include 'headerEm.php'; ?>

    <div id="content">
        <!-- Signup form section -->
        <div class="login-form">
            <h1>Signup</h1>
            
            <?php
            // Displaying errors if there's any
            if (!empty($errors)) {
                echo '<div id="error-messages">';
                foreach ($errors as $error) {
                    echo "<p style='color: red;'>$error</p>";
                }
                echo '</div>';
            }
            ?>
            
            <!-- Signup form -->
            <form action="signup_process.php" method="post" id="signup" novalidate>
                <!-- User input field -->
                <div class="form-group">
                    <label for="username">User: 
                        <input type="text" id="username" name="username">
                        <?php
                        // Displaying errors for the username field
                        if (!empty($errors['username'])) {
                            echo "<span class='error-message' style='color: red;'>{$errors['username']}</span>";
                        }
                        ?>
                        <br><br>
                    </label>
                </div>

                <!-- Email input field -->
                <div class="form-group">
                    <label for="email">Email Address: 
                        <input type="email" id="email" name="email">
                        <?php
                        // Displaying errors for the email field
                        if (!empty($errors['email'])) {
                            echo "<span class='error-message' style='color: red;'>{$errors['email']}</span>";
                        }
                        ?>
                    
                    <br><br>
                    </label>
                </div>

                <!-- Password input field -->
                <div class="form-group">
                    <label for="password">Password: 
                        <input type="password" id="password" name="password">
                        <?php
                        // Displaying errors for the password field
                        if (!empty($errors['password'])) {
                            echo "<span class='error-message' style='color: red;'>{$errors['password']}</span>";
                        }
                        ?>
                    
                    <br><br>
                    </label>
                </div>

                <!-- Password confirmation input field -->
                <div class="form-group">
                    <label for="password_confirmation">Re-type password: 
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        <?php
                        // Displaying errors for the password confirmation field
                        if (!empty($errors['password_confirmation'])) {
                            echo "<span class='error-message' style='color: red;'>{$errors['password_confirmation']}</span>";
                        }
                        ?>
                    
                    <br><br>
                    </label>
                </div>

                <!-- Signup button -->
                <div class="form-group">
                    <button>Sign up</button>
                </div>
            </form>
        </div>
    </div>

    <?php include("footerEm.php"); ?>
</body>

</html>

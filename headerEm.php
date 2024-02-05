<!doctype html>

<html lang="en">

<head>
  <!-- Setting the title and character set for the HTML document -->
  <title>Items System</title>
  <meta charset="utf-8">
</head>

<body>
  <!-- Navigation section -->
  <navigation>
    <!-- Logo link with an image -->
    <a href="#" class="logo"><img src="logo.jpg" alt=""></a>

    <!-- Navigation menu with Home Page, Control Panel, and My Cart links -->
    <ul class="navmenu">
      <li><a href="index.php">Home Page</a></li>
      <li><a href="createItems.php">Control Panel</a></li>
      <li><a href="cart.php">My Cart</a></li>

      <?php
      // Starting a session to check user login status
      session_start();

      // Check if the user is logged in
      if (isset($_SESSION['username'])) {
        // Displaying username and logout link
        echo '<li>Welcome, ' . $_SESSION['username'] . '!</li>';
        echo '<li><a href="logout.php">Logout</a></li>';
      } else {
        // Displaying login and signup links
        echo '<li><a href="login.php">Log in</a></li>';
        echo '<li><a href="signup.php">Sign up</a></li>';
      }
      ?>
    </ul>

    <!-- Navigation icon section with search, user, cart icons, and menu icon -->
    <div class="nav-icon">
      <a href="#"><i class='bx bx-search'></i></a>
      <a href="#"><i class='bx bx-user'></i></a>
      <a href="#"><i class='bx bx-cart'></i></a>
      <div class=" bx bx-menu" id="menu-icon"></div>
    </div>
  </navigation>
</body>

</html>

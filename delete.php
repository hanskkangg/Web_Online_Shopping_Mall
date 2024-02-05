<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Include external stylesheet -->
  <link rel="stylesheet" media="all" href="style.css" />
</head>

<body>
  <?php
  // Include necessary PHP files
  require_once('db_credentials.php');
  require_once('database.php');

  // Connect to the database
  $db = db_connect();

  // Include header
  include "headerEm.php";

  // Check if 'id' is not set in the URL, redirect to createItems.php
  if (!isset($_GET['id'])) {
    header("Location:  createItems.php");
  }

  // Get the 'id' from the URL
  $id = $_GET['id'];

  // Handle form submission for deletion
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // SQL query to delete item with the given 'id'
    $sql = "DELETE FROM items WHERE id ='$id'";
    $result = mysqli_query($db, $sql);

    // Redirect to createItems.php after deletion
    header("Location: createItems.php");
  } else {
    // Retrieve item information for display
    $sql = "SELECT * FROM items WHERE id= '$id' ";
    $result_set = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($result_set);
  }

  ?>

  <?php $page_title = 'Delete Page'; ?>

  <div id="content">

    <!-- Link to go back to item list -->
    <a class="back-link" href="createItems.php">&laquo; Back to List</a>

    <div class="page delete">
      <h1>Delete Page</h1>
      <p>Are you sure you want to delete this Item?</p>
      <!-- Display the item name for confirmation -->
      <p class="item">
        <?php echo $result['name']; ?>
      </p>

      <!-- Form for confirming deletion -->
      <form form action="<?php echo 'delete.php?id=' . $result['id']; ?>" method="post">
        <div id="operations">
          <!-- Submit button for deletion -->
          <input type="submit" name="commit" value="Delete Items" />
        </div>
      </form>
    </div>

    <!-- Include footer -->
    <?php include 'footerEm.php'; ?>
  </div>
</body>

</html>

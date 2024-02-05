<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Include external stylesheet -->
  <link rel="stylesheet" media="all" href="style.css" />
  <!-- Set the title of the page -->
  <title>PHP_DB</title>
</head>

<body>
  <!-- Include header -->
  <?php include("headerEm.php") ?>

  <?php
  // Include necessary PHP files for database connection
  require_once('db_credentials.php');
  require_once('database.php');

  // Connect to the database
  $db = db_connect();
  //$page_title = 'Products'; 
  ?>

  <?php
  // SQL query to select all items from the 'items' table
  $sql = "SELECT * FROM items ";
  // Uncomment the line below to order the results by price in ascending order
  //$sql .= "ORDER BY price ASC";
  // Execute the query
  $result_set = mysqli_query($db, $sql);
  ?>

  <div id="content">
    <div class="subjects listing">
      <h1>PRODUCTS</h1>

      <!-- Actions section with a link to create a new item -->
      <div class="actions">
        <a class="action" href="new.php">Create New Item</a>
      </div>

      <!-- Table to display a list of items -->
      <table class="list">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Image</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>

        <!-- Loop through the result set and display each item in a table row -->
        <?php while ($results = mysqli_fetch_assoc($result_set)) { ?>
          <tr>
            <td><?php echo $results['id']; ?></td>
            <td><?php echo $results['name']; ?></td>
            <td><?php echo $results['description']; ?></td>
            <td><?php echo $results['price']; ?></td>
            <td><?php echo '<img src="' . $results['image'] . '" class="itemImg">'; ?></td>
            <td><a class="action" href="<?php echo "show.php?id=" . $results['id']; ?>">View</a></td>
            <td><a class="action" href="<?php echo "edit.php?id=" . $results['id']; ?>">Edit</a></td>
            <td><a class="action" href="<?php echo "delete.php?id=" . $results['id']; ?>">Delete</a></td>
          </tr>
        <?php } ?>
      </table>
      <br>
      <br>

      <!-- Include footer -->
      <?php include("footerEm.php"); ?>
    </div>
  </div>

</body>

</html>

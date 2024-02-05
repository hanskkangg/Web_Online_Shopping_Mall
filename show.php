<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Linking the external stylesheet -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <?php
  // Including necessary files for database operations
  require_once('db_credentials.php');
  require_once('database.php');
  // Including the header file
  include "headerEm.php";
  // Connecting to the database
  $db = db_connect();
  // Accessing URL parameter 'id'
  $id = $_GET['id'];

  // Query to retrieve item details based on the provided id
  $sql = "SELECT * FROM items WHERE id= '$id' ";
  $result_set = mysqli_query($db, $sql);

  // Fetching the result as an associative array
  $result = mysqli_fetch_assoc($result_set);
  ?>

  <div id="content">
    <!-- Link to navigate back to the item list -->
    <a class="back-link" href="createItems.php"> Back to List</a>

    <div class="page-show">
      <!-- Displaying the item name -->
      <h1>
        <?php echo $result['name']; ?>
      </h1>

      <div class="attributes">
        <dl>
          <dt>Items Name</dt>
          <!-- Displaying the item name -->
          <dd>
            <?php echo $result['name']; ?>
          </dd>
        </dl>
        <dl>
          <dt>Items Description</dt>
          <!-- Displaying the item description -->
          <dd>
            <?php echo $result['description']; ?>
          </dd>
        </dl>
        <dl>
          <dt>Item Price</dt>
          <!-- Displaying the item price -->
          <dd>
            <?php echo $result['price']; ?>
          </dd>
        </dl>
        <dl>
          <dt>Item Image</dt>
          <!-- Displaying the item image -->
          <dd>
            <?php
            if (!empty($result['image'])) {
              echo '<img src="' . $result['image'] . '" class="view-img" alt="Item Image">';
            } else {
              echo 'No Image Available';
            }
            ?>
          </dd>
        </dl>
      </div>
    </div>
  </div>

  <?php
  // Including the footer file
  include 'footerEm.php';
  ?>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Linking the external stylesheet -->
  <link rel="stylesheet" media="all" href="style.css" />
  <!-- Setting the title of the HTML page -->
  <title>PHP_DB</title>
</head>

<body>

  <!-- Including the header file -->
  <?php include("headerEm.php") ?>

  <?php
  // Including necessary files for database connection
  require_once('db_credentials.php');
  require_once('database.php');

  // Connecting to the database
  $db = db_connect();
  
  // SQL query to fetch all items from the database
  $sql = "SELECT * FROM items ";
  $result_set = mysqli_query($db, $sql);
  ?>

  <div id="content">
    <div class="subjects listing">
      <!-- Heading for the products section -->
      <h1>PRODUCTS</h1>
      
      <!-- Including the search box -->
      <?php include("search-box.php"); ?>

      <div class="allItems">
        <!-- Loop through each item from the database -->
        <?php while ($results = mysqli_fetch_assoc($result_set)) { ?>
          <div class="products">
            <!-- Displaying the item image -->
            <img src="<?php echo $results['image']; ?>" class="productImg" alt="Item Image">
            <h3>
              <?php echo $results['name']; ?>
            </h3>
            <p>
              <?php echo $results['description']; ?>
            </p>
            <!-- Displaying the item price -->
            <p>Price: $
              <?php echo $results['price']; ?>
            </p>
            <!-- Link to add the item to the cart -->
            <a href="add_to_cart.php?item_id=<?= $results['id']; ?>" class="addToCart">Add to Cart</a>
          </div>
        <?php } ?>
      </div>

      <br>
      <br>
      <!-- Placeholder for additional actions -->
      <div class="actions">
      </div>

      <!-- Including the footer file -->
      <?php include("footerEm.php"); ?>
    </div>
  </div>

</body>

</html>

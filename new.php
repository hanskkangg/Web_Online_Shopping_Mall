<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Linking the external stylesheet -->
  <link rel="stylesheet" media="all" href="style.css" />
</head>

<body>

  <!-- Including the header file -->
  <?php include 'headerEm.php'; ?>

  <div id="content">

    <!-- Link to navigate back to the item list -->
    <a class="back-link" href="<?php echo 'createItems.php'; ?>"> Back to List</a>

    <div class="New Items">
      <!-- Heading for creating a new item -->
      <h1>Create New Item</h1>

      <!-- Form for creating a new item, action set to 'create.php' with POST method -->
      <form action='create.php' method="POST">

        <dl>
          <!-- Item Name input field -->
          <dt>Item Name</dt>
          <dd><input type="text" name="name" /></dd>
        </dl>
        <dl>
          <!-- Item Description input field -->
          <dt>Item Description</dt>
          <dd><input type="text" name="description" /></dd>
        </dl>
        <dl>
          <!-- Item Price input field -->
          <dt>Item Price</dt>
          <dd><input type="text" name="price" /></dd>
        </dl>
        <dl>
          <!-- Item Image input field -->
          <dt>Item Image</dt>
          <dd><input type="File" name="image" /></dd>
        </dl>
        <div id="operations">
          <!-- Submit button to create the item -->
          <input type="submit" value="Create Item" />
        </div>
      </form>
    </div>
  </div>

  <!-- Including the footer file -->
  <?php include 'footerEm.php'; ?>

</body>

</html>

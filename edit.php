<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Include external stylesheet -->
  <link rel="stylesheet" media="all" href="style.css" />
</head>

<?php
// Include necessary PHP files
require_once('db_credentials.php');
require_once('database.php');
include("headerEm.php");

// Connect to the database
$db = db_connect();

// Redirect to index.php if 'id' is not set in the URL
if (!isset($_GET['id'])) {
    header("Location:  index.php");
}
$id = $_GET['id'];

$page_title = 'Edit Items';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form values
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Fetch item information for display
    $sql = "SELECT * FROM items WHERE id= '$id' ";
    $result_set = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($result_set);

    // Check if a new image is provided
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == UPLOAD_ERR_OK) {
        // Handle the new image upload
        $newImagePath = 'uploads/' . basename($_FILES['new_image']['name']);
        move_uploaded_file($_FILES['new_image']['tmp_name'], $newImagePath);
        $image = 'img/' . basename($_FILES['new_image']['name']); // Prefixing with 'img/'
        $result['image'] = $image; // Update the result array for display
    } else {
        // Keep the existing image path if no new image is provided
        $image = $result['image'];
    }

    // Update the table with new information
    $sql = "UPDATE items SET name='$name', description='$description', price='$price', image='$image' WHERE id='$id'";
    $result = mysqli_query($db, $sql);

    // Redirect to show page after updating
    header("Location: show.php?id=$id");
} else {
    // Fetch item information for display
    $sql = "SELECT * FROM items WHERE id= '$id' ";
    $result_set = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($result_set);
}
?>


  <div id="content">

    <!-- Link to go back to item list -->
    <a class="back-link" href="createItems.php"> Back to List</a>

    <div class="page edit">
      <h1>Edit Items</h1>

      <!-- Form for editing item information -->
      <form action="<?php echo 'edit.php?id=' . $result['id']; ?>" method="post" enctype="multipart/form-data">
        <dl>
          <!-- Input field for Name -->
          <dt>Name</dt>
          <dd><input type="text" name="name" value="<?php echo $result['name']; ?>" /></dd>
        </dl>
        <dl>
          <!-- Input field for Description -->
          <dt>Description</dt>
          <dd><input type="text" name="description" value="<?php echo $result['description']; ?>" /></dd>
        </dl>
        <dl>
          <!-- Input field for Price -->
          <dt>Price</dt>
          <dd><input type="text" name="price" value="<?php echo $result['price']; ?>" /></dd>
        </dl>
        <dl>
          <!-- Display current image path -->
          <dt>Current Image</dt>
          <dd><?php echo $result['image']; ?></dd>
        </dl>
        <dl>
          <!-- Input field for New Image -->
          <dt>New Image</dt>
          <dd><input type="file" name="new_image" /></dd>
        </dl>

        <div id="operations">
          <!-- Submit button for form -->
          <input type="submit" value="Edit Items" />
        </div>
      </form>

    </div>

  </div>

  <?php include 'footerEm.php'; ?>
</body>

</html>

<?php

// Include necessary PHP files for database connection
require_once('db_credentials.php');
require_once('database.php');

// Include header
include "headerEm.php";

// Connect to the database
$db = db_connect();

// Check if the form has been submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve form values
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $_POST['image'];

  // SQL query to insert a new item into the 'items' table
  $sql = "INSERT INTO items (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
  
  // Execute the SQL query
  $result = mysqli_query($db, $sql);
  
  // Get the ID of the newly inserted item
  $id = mysqli_insert_id($db);

  // Redirect to the show page for the newly created item
  header("Location: show.php?id=$id");
} else {
  // If the form has not been submitted, redirect to the new.php page
  header("Location: new.php");
}

?>

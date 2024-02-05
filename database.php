<?php

// Include external file containing database connection constants
require_once('db_credentials.php');

// Function to establish a database connection
function db_connect()
{
  // Attempt to connect to the database using defined constants
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  
  // Call a function to confirm the success of the database connection
  confirm_db_connect();
  
  // Return the established connection
  return $connection;
}

// Function to close a database connection
function db_disconnect($connection)
{
  // Check if the connection is set before attempting to close it
  if (isset($connection)) {
    // Close the database connection
    mysqli_close($connection);
  }
}

// Function to confirm the success of a database connection
function confirm_db_connect()
{
  // Check if there was an error during the database connection attempt
  if (mysqli_connect_errno()) {
    // Construct an error message with details about the connection failure
    $msg = "Database connection failed: ";
    $msg .= mysqli_connect_error();
    $msg .= " (" . mysqli_connect_errno() . ")";
    
    // Exit the script and display the error message
    exit($msg);
  }
}

// Function to confirm the success of a database query result set
function confirm_result_set($result_set)
{
  // Check if the result set is empty or false, indicating a query failure
  if (!$result_set) {
    // Exit the script and display a generic error message
    exit("Database query failed.");
  }
}

?>

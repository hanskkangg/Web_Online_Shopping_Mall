<!-- add_to_cart.php -->

<?php
// Start or resume the session to access session variables
session_start();

// Include necessary PHP files for database connection
require_once('db_credentials.php');
require_once('database.php');

// Connect to the database
$db = db_connect();

// Check if the 'item_id' is set in the GET parameters
if (isset($_GET['item_id'])) {
    // Retrieve the 'item_id' from the GET parameters
    $item_id = $_GET['item_id'];

    // Add item to the cart
    // Check if the 'cart' session variable is not set
    if (!isset($_SESSION['cart'])) {
        // Initialize 'cart' as an empty array if not set
        $_SESSION['cart'] = array();
    }

    // Check if the item is not already in the cart
    if (!in_array($item_id, $_SESSION['cart'])) {
        // Add the item to the 'cart' session variable
        $_SESSION['cart'][] = $item_id;
    }
}

// Redirect back to the previous page (index.php)
header("Location: index.php");
exit();
?>

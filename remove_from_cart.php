<?php
session_start();

if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    // Find the index of the item in the cart array
    $index = array_search($itemId, $_SESSION['cart']);

    // Check if the item is in the cart array
    if ($index !== false) {
        // Remove the item from the cart array
        unset($_SESSION['cart'][$index]);
        echo "Item removed successfully";
    } else {
        echo "Item not found in the cart";
    }
} else {
    echo "Invalid request";
}
?>
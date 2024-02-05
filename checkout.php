<?php
// Start the session to manage user data across pages
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Check if the form is submitted using POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the "payment" by clearing the cart
        unset($_SESSION['cart']);
        $thankYouMessage = "Thank you! Your order has been successfully placed.";
    }
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Include your CSS styles here -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Container for the checkout page -->
    <div class="checkout-container">
        <?php
        // Check if a thank you message is set
        if (isset($thankYouMessage)) {
            // Display thank you message
            echo "<h1>$thankYouMessage</h1>";
        } else {
            // Display the selected items for review
            echo "<h1>Review Your Order</h1>";
            echo "<div class='cart-items'>";
            $totalPrice = 0;

            // Loop through the items in the cart
            foreach ($_SESSION['cart'] as $item_id) {
                // Replace this with your actual database logic to get product details
                $productDetails = getProductDetails($item_id);

                // Check if product details are available
                if ($productDetails !== null) {
                    $totalPrice += $productDetails['price'];
                    ?>
                    <!-- Display individual cart item details -->
                    <div class="cart-item">
                        <img src="<?php echo $productDetails['image']; ?>" alt="Product Image">
                        <div class="product-details">
                            <p>Product ID:
                                <?php echo $item_id; ?>
                            </p>
                            <p>Product Name:
                                <?php echo $productDetails['name']; ?>
                            </p>
                            <p>Product Price: $
                                <?php echo $productDetails['price']; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            }

            // Display the total price of the order
            echo "<p>Total Price: $totalPrice</p>";
            echo "</div>";

            // Display a "Pay" button
            ?>
            <!-- Form for payment submission -->
            <form action="checkout.php" method="post">
                <input type="submit" value="Pay">
            </form>
            <?php
        }
        ?>
    </div>
</body>

</html>

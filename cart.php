<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character set and viewport for responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the title of the page -->
    <title>Shopping Cart</title>
    <!-- Include external stylesheet and additional inline styles -->
    <link rel="stylesheet" media="all" href="<?php echo 'style.css'; ?>" />
    <style>
        /* Add your additional styles here */
    </style>
</head>

<body>
    <!-- Include the header -->
    <?php include("headerEm.php") ?>

    <?php
    // Start the session if not already started
    require_once('db_credentials.php');
    require_once('database.php');

    $db = db_connect();

    // Add the getProductDetails function (replace with your actual database logic)
    function getProductDetails($item_id)
    {
        global $db;
        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $item_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $productDetails = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $productDetails;
    }

    // Pay button logic
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION['username'])) {
            // Process the "payment" (for the sake of this example, just clear the cart)
            unset($_SESSION['cart']);
            $thankYouMessage = "Thank you! Your order has been successfully placed.";
        } else {
            // Redirect to login or signup page if not logged in
            header("Location: login.php");
            exit();
        }
    }
    ?>

    <!-- Container for the shopping cart -->
    <div class="shop-cart">
        <h1>Shopping Cart</h1>

        <!-- Display the cart items if the cart is not empty -->
        <div class="cart-items">
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $item_id) {
                    // Ensure $item_id is defined before using it
                    if (isset($item_id)) {
                        $productDetails = getProductDetails($item_id);

                        // Check if productDetails is not null before accessing its elements
                        if ($productDetails !== null) {
                            ?>
                            <!-- Display individual cart item details -->
                            <div class="cart-item">
                                <img src="<?php echo $productDetails['image']; ?>" alt="Product Image">
                                <div class="product-details">
                                    <p>Product ID:
                                        <?php echo $item_id; ?>
                                    </p>
                                    <p>Product Name:
                                        <?php echo isset($productDetails['name']) ? $productDetails['name'] : 'N/A'; ?>
                                    </p>
                                    <p>Product Price:
                                        <?php echo isset($productDetails['price']) ? $productDetails['price'] : 'N/A'; ?>
                                    </p>
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" class="quantity-btn">
                                    <button class="remove-btn" onclick="removeFromCart(<?php echo $item_id; ?>)">Remove</button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            } else {
                echo "<p>Your cart is now empty.</p>";
            }
            ?>
            
        </div><!-- Pay button or login/signup message -->
<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
    <form action="cart.php" method="post">
        <input type="submit" name="pay" value="Pay">
    </form>
<?php else: ?>
    <!-- Display "Back to Products" link only when the cart is empty -->
    <p><a href="index.php">Back to Products</a></p>
<?php endif; ?>

<?php if (!isset($_SESSION['username'])): ?>
    <p>Please <a href="login.php">log in</a> or <a href="signup.php">sign up</a> to complete your purchase.</p>
<?php endif; ?>
<?php if (isset($thankYouMessage)): ?>
    <p>
        <?php echo $thankYouMessage; ?>
        <!-- Add a link to go back to products after displaying the thank you message -->
    </p>
<?php endif; ?>



    </div>

    <!-- JavaScript function to remove items from the cart -->
    <script>
        function removeFromCart(itemId) {
            // Send an AJAX request to remove the item from the cart
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Refresh the page or update the cart display dynamically
                        window.location.reload();
                    } else {
                        console.error("Error removing item from cart:", xhr.statusText);
                    }
                }
            };
            xhr.open("GET", "remove_from_cart.php?id=" + itemId, true);
            xhr.send();
        }
    </script>

    <!-- Include the footer -->
    <?php include("footerEm.php"); ?>
</body>

</html>

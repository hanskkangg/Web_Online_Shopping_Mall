<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set and viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title for the page -->
    <title>Search box</title>
    <!-- Linking the external stylesheet -->
    <link rel="stylesheet" media="all" href="<?php echo 'style.css'; ?>" />
</head>

<body>

    <!-- Search form -->
    <form action="" method="GET">
        <div class="input-group">
            <!-- Name selection dropdown -->
            <select name="name" class="filter">
                <option value="" <?php echo empty($_GET['name']) ? 'selected' : ''; ?>>All Brands</option>
                <option value="adidas" <?php echo (isset($_GET['name']) && $_GET['name'] === 'adidas') ? 'selected' : ''; ?>>Adidas</option>
                <option value="nike" <?php echo (isset($_GET['name']) && $_GET['name'] === 'nike') ? 'selected' : ''; ?>>
                    Nike</option>
                <option value="puma" <?php echo (isset($_GET['name']) && $_GET['name'] === 'puma') ? 'selected' : ''; ?>>
                    Puma</option>
                <option value="under_armour" <?php echo (isset($_GET['name']) && $_GET['name'] === 'under_armour') ? 'selected' : ''; ?>>Under Armour</option>
            </select>

            <!-- Search bar -->
            <input type="text" name="search" class="search-bar" value="<?php if (isset($_GET['search'])) {
                echo $_GET['search'];
            } ?>" placeholder="Search Products">

            <!-- Search button -->
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <?php
    // Including necessary files for database operations
    require_once('db_credentials.php');
    require_once('database.php');

    // Connect to the database
    $db = db_connect();

    // Check if search parameters are provided
    if (isset($_GET['search'])) {
        $filtervalues = $_GET['search'];
        $name = isset($_GET['name']) ? $_GET['name'] : '';

        // Build the query based on the selected name
        $query = "SELECT * FROM items WHERE CONCAT(name, description) LIKE '%" . $filtervalues . "%'";
        if (!empty($name)) {
            $query .= " AND name = '" . $name . "'";
        }

        // Execute the query
        $query_run = mysqli_query($db, $query);

        // Check if the query was successful
        if ($query_run) {
            ?>
            <!-- Display filtered items -->
            <div class="filterItems">
                <?php
                // Loop through the result set and display items
                while ($item = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <div class="products">
                        <div>
                            <!-- Display item image -->
                            <img src="<?= $item['image']; ?>" class="productImg" alt="Item Image">
                        </div>
                        <h3>
                            <!-- Display item name -->
                            <?= $item['name']; ?>
                        </h3>
                        <p>
                            <!-- Display item description -->
                            <?= $item['description']; ?>
                        </p>
                        <p>Price: $
                            <!-- Display item price -->
                            <?= $item['price']; ?>
                        </p>
                        <!-- Add to cart link -->
                        <a href="add_to_cart.php?item_id=<?= $item['id']; ?>" class="addToCart">Add to Cart</a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        } else {
            // Handle query execution error
            echo "Error: " . mysqli_error($db);
        }
    }
    ?>

    <!-- Include JavaScript file -->
    <script src="script/script.js"></script>
</body>

</html>

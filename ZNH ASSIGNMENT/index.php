<?php
include_once "../includes/dataAccess.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sun Products</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Message Section -->
    
    <!-- Header Section -->
    <?php include 'header.php'; ?>

    <!-- Main Content Section -->
    <main class="container my-5 flex-grow-1">
        <div class="container">
            <?php if (isset($_GET['status'])): ?>
                <div class="alert alert-success">
                    Logged In
                </div>
            <?php endif; ?>
        </div>

        <div id="searchResults" class="mb-4">

            <!-- Filter Form -->
            <section class="filter mb-4">
                <form class="form-inline" method="POST" action="/ZNH ASSIGNMENT/includes/process.php">
                    <label class="mr-2" for="category">Category:</label>
                    <select id="category" name="category" class="form-control mr-3">
                        <option value="all">All</option>
                        <option value="electronics">Electronics</option>
                        <option value="fashion">Fashion</option>
                        <option value="home">Home</option>
                    </select>
                    <button type="submit" class="btn btn-primary" name="filter">Filter</button>
                </form>
            </section>

            <!-- Item Catalog -->
            <section class="item-catalog row">
                <?php
                // Create a new DataAccess object
                $dataAccess = new DataAccess();

                // Retrieve products based on the filter
                if (isset($_GET["category"])) {
                    $category_filter = $_GET["category"];
                    if ($category_filter === "all") {
                        $products = $dataAccess->retrieve_All_Products();
                    } else {
                        $products = $dataAccess->retrieve_Product_By_Category($_GET["category"]);
                    }
                } else {
                    $products = $dataAccess->retrieve_All_Products();
                }

                // Check if any products exist
                if (empty($products)) {
                    echo '<div class="alert alert-warning text-center" role="alert">No products available.</div>';
                } else {
                    // Loop through each product and display it
                    foreach ($products as $product) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <!-- Product Image -->
                                <img src="<?php echo str_replace('C:\\xampp\\htdocs\\', '/', $product['PRODUCT_IMAGE']); ?>"
                                     alt="<?php echo htmlspecialchars($product['PRODUCT_NAME'] ?? 'Product Image'); ?>" 
                                     class="card-img-top" 
                                     style="width:100%">
                                <div class="card-body">
                                    <!-- Product Name -->
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['PRODUCT_NAME'] ?? 'Unknown Product'); ?></h5>
                                    <!-- Product Price -->
                                    <p class="card-text">Price: $<?php echo number_format($product['PRICE'], 2) ?? '0.00'; ?></p>
                                    <!-- Link to Product Details -->
                                    <a href="product.php?id=<?php echo htmlspecialchars($product['ID']); ?>" class="btn btn-primary">See More</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </section>
        </div>
    </main>

    <!-- Footer Section -->
    <?php include('footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

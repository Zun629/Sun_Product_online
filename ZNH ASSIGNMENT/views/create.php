<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Header Section -->
    <?php include 'header.php'; ?>

    <main class="container my-5 flex-grow-1">
    <h1 class="text-center mb-4">Product Management</h1>
    
    <!-- Product Management Form -->
    <form action="/ZNH ASSIGNMENT/includes/process.php" method="POST" enctype="multipart/form-data">
        <!-- Product Name -->
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="product_name" placeholder="Enter product name" required>
        </div>

        <!-- Product Image -->
        <div class="form-group">
            <label for="productImage">Upload Product Image</label>
            <input type="file" class="form-control-file" id="productImage" name="image" accept="image/*" required>
        </div>

        <!-- Product Price -->
        <div class="form-group">
            <label for="productPrice">Product Price</label>
            <input type="number" class="form-control" id="productPrice" name="product_price" placeholder="Enter product price" step="0.01" required>
        </div>

        <!-- Product Category -->
        <div class="form-group">
            <label for="productCategory">Product Category</label>
            <select class="form-control" id="productCategory" name="product_category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="electronics">Electronics</option>
                <option value="fashion">Fashion</option>
                <option value="home">Home & Kitchen</option>
                <option value="books">Books</option>
            </select>
        </div>

        <!-- Product Status -->
        <div class="form-group">
            <label>Product Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="statusActive" name="product_status" value="active" required>
                <label class="form-check-label" for="statusActive">Active</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="statusInactive" name="product_status" value="inactive" required>
                <label class="form-check-label" for="statusInactive">Inactive</label>
            </div>
        </div>

        <!-- Product Description -->
        <div class="form-group">
            <label for="productDescription">Product Description</label>
            <textarea class="form-control" id="productDescription" name="product_description" rows="3" placeholder="Enter product description" required></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="list-product" class="btn btn-primary btn-block">List Product</button>
    </form>
</main>

    <?php include('footer.php') ?>
    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

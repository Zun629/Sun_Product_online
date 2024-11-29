<?php
include_once "../includes/dataAccess.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();

// Get the ID from the query string
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Sanitize the input for security
    $productID = htmlspecialchars($productID);

    // Create a new DataAccess object
    $dataAccess = new DataAccess();

    // Retrieve all products
    $product_details = $dataAccess->retrieve_Product_By_ID($productID);
} else {
    echo "No product ID specified.";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Header Section -->
<?php include 'header.php'; ?>

<!-- Product Information Section -->
<div class="container mt-4">
    <div class="row">
        <!-- Product Image and Details -->
        <div class="col-md-6">
            <img src="https://placehold.co/400x400/000000/FFF?text=Image Unavailable" alt="Product Image" class="img-fluid">
        </div>

        <div class="col-md-6">
            <h2><?php echo $product_details['PRODUCT_NAME']?></h2>
            <p><strong>Seller:</strong><?php echo $product_details['PRODUCT_NAME']?> </p>
            <p><strong>Posted Date:</strong> <?php echo $product_details['SELLER_ID']?></p>
            <p><strong>Price:</strong> <?php echo $product_details['PRICE']?></p>
            <p><strong>Status:</strong> <?php if($product_details['STATUS']!== 0 ){echo "OUT OF STOCK";}else{echo "INSTOCK";}?></p>
            <p><strong>Category:</strong> <?php echo $product_details['CATEGORY']?></p>
            
            <h5>Product Description</h5>
            <p><?php echo $product_details['DESCRIPTION']?></p>            
            <!-- Add to Cart Button -->
             <?php
                if(isset($_SESSION["username"])){

                
            ?>
            <a href="checkout.php?id=<?php echo htmlspecialchars($productID); ?>" class="btn btn-success btn-lg">Add to Cart</a>

            <?php
            }else{
                ?>
            <a href="login.php" class="btn btn-success btn-lg">Login to Order</a>

            <?php
            }
            ?>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="mt-4">
        <h4>Customer Reviews</h4>

        <!-- Review 1 -->
        <div class="media mb-3">
            <img src="https://placehold.co/400x400/000000/FFF?text=J" class="mr-3" alt="Reviewer Image" style="width: 50px; height: 50px;">
            <div class="media-body">
                <h5 class="mt-0">John Revolver</h5>
                <p><strong>Reviewed on:</strong> January 2, 2024</p>
                <p>Great product! Highly recommend it. The quality is amazing and it's just what I was looking for!</p>
            </div>
        </div>

        <!-- Review 2 -->
        <div class="media mb-3">
            <img src="https://placehold.co/400x400/000000/FFF?text=S" class="mr-3" alt="Reviewer Image" style="width: 50px; height: 50px;">
            <div class="media-body">
                <h5 class="mt-0">Sam Pal</h5>
                <p><strong>Reviewed on:</strong> January 3, 2024</p>
                <p>Not satisfied with the product. It did not meet my expectations.</p>
            </div>
        </div>

        <!-- Add More Reviews Here -->
    </div>

    <!-- Similar Products Section -->
    <div class="mt-4">
        <h4>Similar Products</h4>
        <div class="row">
            <!-- Similar Product 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://placehold.co/400x400/000000/FFF?text=<?php echo $product = $product_details['PRODUCT_NAME']?> Version 2" class="card-img-top" alt="Similar Product">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product?> Version 2</h5>
                        <p class="card-text">$149.99</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>

            <!-- Similar Product 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://placehold.co/400x400/000000/FFF?text=<?php echo $product = $product_details['PRODUCT_NAME']?> Premium" class="card-img-top" alt="Similar Product">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product ?> Premium</h5>
                        <p class="card-text">$169.99</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>

            <!-- Similar Product 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://placehold.co/400x400/000000/FFF?text=Image Unavailable" class="card-img-top" alt="Similar Product">
                    <div class="card-body">
                        <h5 class="card-title">Recommended Product</h5>
                        <p class="card-text">$189.99</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<?php include('footer.php'); ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

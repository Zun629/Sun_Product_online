<?php
include_once "../includes/dataAccess.php";
$dataAccess = new DataAccess();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding products to the cart
if (isset($_GET['id'])) {
    $productID = htmlspecialchars($_GET['id']);

    if (isset($_SESSION['cart'][$productID])) {
        // Increment item count
        $_SESSION['cart'][$productID]['item_count']++;
    } else {
        // Add new product to cart
        $_SESSION['cart'][$productID] = [
            'product_id' => $productID,
            'item_count' => 1,
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Header Section -->
<?php include 'header.php'; ?>

<div class="container my-5 flex-grow-1">
<div id="searchResults" class="mb-4">
    <h2 class="text-center mb-4">Shopping Cart</h2>

    <?php if (isset($_GET['status'])) {
    ?>
        <div class="alert alert-success">
                                Thank You for Ordering!
                            </div>
    <?php
    }
    ?>
    <!-- Display Cart Items -->
    <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $productID => $item): ?>
            <?php
            // Fetch product details
            
            $product_details = $dataAccess->retrieve_Product_By_ID($productID);

            // Variables
            $productName = htmlspecialchars($product_details['PRODUCT_NAME']);
            $productPrice = $product_details['PRICE'];
            $itemCount = $item['item_count'];
            $totalPrice = $productPrice * $itemCount;
            ?>
            <div class="row mb-4">
                <div class="col-md-2">
                    <img src="C:\xampp\htdocs\ZNH Assignment\includes/files/product/TurkeyInflationHeader.jpg" class="img-fluid" alt="<?php echo $productName; ?>">
                </div>
                <div class="col-md-4">
                    <h5><?php echo $productName; ?></h5>
                    <p>Price: $<?php echo number_format($productPrice, 2); ?></p>
                    <p>Quantity: <?php echo $itemCount; ?></p>
                </div>
                <div class="col-md-4">
                    <h5>Total: $<?php echo number_format($totalPrice, 2); ?></h5>
                </div>
                <div class="col-md-2">
                    <!-- Remove Item Button -->
                    <form method="POST" action="/ZNH ASSIGNMENT/includes/process.php">
                        <input type="hidden" name="product_id" value="<?php echo $productID; ?>">
                        <button type="submit" class="btn btn-danger btn-sm" name="remove_item">Remove</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">Your cart is empty.</p>
    <?php endif; ?>

    <!-- Coupon Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h4>Got a Coupon?</h4>
            <input type="text" class="form-control" id="couponCode" placeholder="Enter Coupon Code">
            <button class="btn btn-primary mt-2" id="applyCoupon">Apply Coupon</button>
        </div>
    </div>

    <!-- Total Cost -->
    <div class="row mb-4">
        <div class="col-md-8 text-right">
            <h4>Total Cost: $<?php echo calculateTotalCost($_SESSION['cart'], $dataAccess); ?></h4>
        </div>
    </div>
    <hr>

    <!-- Payment Method -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h4>Choose Payment Method</h4>
            <select class="form-control">
                <option value="credit-card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank-transfer">Bank Transfer</option>
            </select>
        </div>
    </div>

    <!-- Confirm Order -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
        <?php if (!empty($_SESSION['cart'])){?>    
        <form method="POST" action="/ZNH ASSIGNMENT/includes/process.php">
                <button type="submit" name="order" class="btn btn-success btn-lg">Confirm Order</button>
            </form>
            <?php } ?>
            
        </div>
    </div>
</div>
</div>

<!-- Footer Section -->
<?php include 'footer.php'; ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Apply Coupon Logic
    $('#applyCoupon').on('click', function() {
        const couponCode = $('#couponCode').val();
        if (couponCode === 'DISCOUNT10') {
            alert('Coupon applied! You get a 10% discount.');
            // Adjust total cost dynamically
        } else {
            alert('Invalid coupon code.');
        }
    });
</script>
</body>
</html>

<?php
function calculateTotalCost($cart, $dataAccess) {
    $total = 0;

    foreach ($cart as $productID => $item) {
        $productDetails = $dataAccess->retrieve_Product_By_ID($productID);
        $total += $productDetails['PRICE'] * $item['item_count'];
    }

    return number_format($total, 2);
}
?>

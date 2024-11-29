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
    <title>About Us</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Header Section -->
<?php include 'header.php'; ?>

<main class="container my-5 flex-grow-1">
    <!-- About Us Section -->
    <section class="row mb-4">
        <!-- Company Logo -->
        <div class="col-md-4 text-center">
            <img src="../views/sun-logo.png" alt="Company Logo" class="img-fluid">
        </div>

        <!-- About Us Description -->
        <div class="col-md-8">
            <h2>About Us</h2>
            <p>
                Welcome to our company. We are dedicated to providing top-notch services and products that meet our customers' needs. Our passion for innovation drives us to be at the forefront of the industry.
            </p>
        </div>
    </section>

    <!-- Company History Section -->
    <section class="row mb-4">
        <div class="col-12">
            <h3>Company History</h3>
            <p>
                Founded in 2010, our company started with a small team of dedicated individuals and has since grown into a recognized leader in the industry. Over the years, we have built a reputation for quality and customer satisfaction.
            </p>
        </div>
    </section>

    <!-- Company Timeline Section -->
    <section class="row mb-4">
        <div class="col-12">
            <h3>Company Timeline</h3>
            <ul class="list-group">
                <li class="list-group-item">2010 - Company founded</li>
                <li class="list-group-item">2012 - Expanded product line</li>
                <li class="list-group-item">2015 - Reached 1 million customers</li>
                <li class="list-group-item">2020 - Launched global operations</li>
            </ul>
        </div>
    </section>

    <!-- CEO Section -->
    <section class="row mb-4">
        <div class="col-md-4 text-center">
            <!-- CEO Picture -->
            <img src="https://placehold.co/200x200/000000/FFF?text=CEO" alt="CEO Picture" class="img-fluid rounded-circle" style="width: 200px; height: 200px;">
        </div>
        <div class="col-md-8">
            <h3>CEO: John Doe</h3>
            <p>
                John Doe is the visionary CEO who has led the company to new heights. With over 20 years of experience in the industry, John has been instrumental in our growth and success. He believes in leading by example and strives to inspire others to reach their full potential.
            </p>
        </div>
    </section>
</main>


<!-- Footer Section -->
<?php include 'footer.php'; ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

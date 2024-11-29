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
    <title>Contact Us</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Header Section -->
<?php include 'header.php'; ?>

<main class="container my-5 flex-grow-1">
<div id="searchResults" class="mb-4">
<!-- Contact Us Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Need to contact us about something?</h2>

    <!-- Contact Form -->
    <form>
        <!-- Email Input -->
        <div class="form-group">
            <label for="email">Your Email Address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
        </div>

        <!-- Reason for Contact Dropdown -->
        <div class="form-group">
            <label for="contactReason">Reason for Contact</label>
            <select class="form-control" id="contactReason" required>
                <option value="" disabled selected>Select a reason</option>
                <option value="support">Customer Support</option>
                <option value="feedback">Feedback</option>
                <option value="inquiry">General Inquiry</option>
                <option value="complaint">Complaint</option>
            </select>
        </div>

        <!-- Description Area -->
        <div class="form-group">
            <label for="description">Message/Description</label>
            <textarea class="form-control" id="description" rows="4" placeholder="Please describe your issue or inquiry" required></textarea>
        </div>

        <!-- File Attachment -->
        <div class="form-group">
            <label for="fileAttachment">Attach a Picture/File (optional)</label>
            <input type="file" class="form-control-file" id="fileAttachment">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

    <hr>

    <!-- Company Picture Slideshow -->
    <!--<div id="companySlideshow" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../includes/files/profile/Slide.png" class="d-block w-100" alt="Company Image 1">
            </div>
            <div class="carousel-item">
                <img src="../includes/files/profile/Slide.png" class="d-block w-100" alt="Company Image 2">
            </div>
            <div class="carousel-item">
                <img src="../includes/files/profile/Slide.png" class="d-block w-100" alt="Company Image 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#companySlideshow" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#companySlideshow" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>-->

    <div class="mt-4 text-center">
        <p>Thank you for contacting us! We'll get back to you as soon as possible.</p>
    </div>
</div>
</div>
</main>
<!-- Footer Section -->
<?php include 'footer.php'; ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

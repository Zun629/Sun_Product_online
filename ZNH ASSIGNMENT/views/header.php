<header class="header bg-primary text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand" href="#">Sun Products</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    
                    <!-- Admin Link -->
                    <?php if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "ADMIN") { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Add Product</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <!-- Search and User Actions -->
        <div class="d-flex align-items-center">
            <!-- Search Form -->
            <input type="text" class="form-control mr-2" placeholder="Search..." name="query" id="searchQuery">

            <!-- Login/Logout and Username -->
            <?php if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) { ?>
                <!-- Display logged-in username -->
                <a href="user_details.php" class="ml-3 text-light">
                <span class="ml-3 text-light"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                </a>
                <form action="/ZNH ASSIGNMENT/includes/process.php" method="POST" class="ml-3">
                    <button type="submit" class="btn btn-outline-light" name="logout">Logout</button>
                </form>
            <?php } else { ?>
                <!-- Login Button -->
                <form action="login.php" class="ml-3">
                    <button class="btn btn-outline-light">Login</button>
                </form>
            <?php } ?>
        </div>
    </div>

    
</header>

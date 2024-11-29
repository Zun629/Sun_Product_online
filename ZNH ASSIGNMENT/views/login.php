<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Welcome Back</h2>

                    <!-- Login Form -->
                    <form action="/ZNH ASSIGNMENT/includes/process.php" method="POST">
                        <!-- Error Message -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger">
                                Wrong Username or Password
                            </div>
                        <?php endif; ?>

                        <!-- Username/Email Input -->
                        <div class="form-group">
                            <label for="email">Username/Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter username or email" required>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="form-group text-right">
                            <a href="#" class="text-muted">Forgot Password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                    </form>

                    <hr>

                    <!-- Social Login Buttons -->
                    <div class="text-center mb-4">
                        <button class="btn btn-danger btn-block mb-2">
                            <i class="fab fa-google"></i> Login with Google
                        </button>
                        <button class="btn btn-primary btn-block mb-2">
                            <i class="fab fa-facebook-f"></i> Login with Facebook
                        </button>
                    </div>

                    <!-- First Time Login Link -->
                    <div class="text-center mt-3">
                        <p class="text-muted">First time? <a href="signup.php">Create an account here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>

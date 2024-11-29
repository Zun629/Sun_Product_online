<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Sign Up</h2>

                    <!-- Sign Up Form -->
                    <form action="/ZNH ASSIGNMENT/includes/process.php" method="POST" enctype="multipart/form-data">
                        
                    <?php if (isset($_GET['status'])){
                        if($_GET['status'] !== "ok"){

                            ?>
                        
                        <div class="alert alert-danger">
                            Please Upload Profile Picture!
                        </div>
                    <?php
                        }
                    } 
                    ?>
                    
                        <!-- Profile Pic Upload -->
                        <div class="form-group text-center">
                            <label for="profile-pic">
                                <i class="fa fa-camera fa-3x" aria-hidden="true"></i>
                            </label>
                            <input type="file" id="profile-pic" class="form-control-file d-none" name="image">
                            <small class="form-text text-muted">Upload your profile picture</small>
                        </div>
                    
                        <!-- Username Input -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                        </div>

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm password" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" name="sign-up" class="btn btn-primary btn-block">Sign Up</button>
                    </form>

                    <!-- Login Link -->
                    <div class="text-center mt-3">
                        <p class="text-muted">Already have an account? <a href="login.php">Login Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

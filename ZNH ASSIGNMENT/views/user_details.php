<?php
session_start();

include_once "../includes/dataAccess.php";

// Handle status messages (success or failure)
$status_message = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        $status_message = '<div class="alert alert-success" role="alert">User details updated successfully!</div>';
    } else {
        $status_message = '<div class="alert alert-danger" role="alert">Failed to update user details. Please try again.</div>';
    }
}

$dataAccess = new DataAccess();
$user_data = $dataAccess->retrieve_User_By_Name($_SESSION["username"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <!-- Bootstrap 4.5.2 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <div class="container my-5 flex-grow-1">
        <h1>User Details</h1>

        <!-- Display status message if any -->
        <?php if ($status_message): ?>
            <?php echo $status_message; ?>
        <?php endif; ?>

        <?php if ($user_data): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_data as $key => $value): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($key); ?></td>
                            <td><?php echo htmlspecialchars($value); ?></td>
                            <td>
                                <button class="btn btn-primary edit-btn"
                                        data-toggle="modal"
                                        data-target="#editModal"
                                        data-field="<?php echo htmlspecialchars($key); ?>"
                                        data-value="<?php echo htmlspecialchars($value); ?>"
                                        >
                                    Edit
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No user data found.</p>
        <?php endif; ?>
        
        <!-- Separate Delete Button -->
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-username="<?php echo $_SESSION["username"] ?>">
            Delete Account
        </button>
        <hr>
        <form action="index.php">
        <button class="btn btn-primary" type="submit">
            Back to Home
        </button>
        </form>
        

    </div>

    <!-- Bootstrap Modal for Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="/ZNH ASSIGNMENT/includes/process.php">
                        <div class="mb-3">
                            <label for="field" class="form-label">Field</label>
                            <input type="text" class="form-control" id="field" name="field" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="value" class="form-label">Value</label>
                            <input type="text" class="form-control" id="value" name="value">
                        </div>
                        <input type="hidden" id="username" name="username">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" name="change">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete your account? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <form action="/ZNH ASSIGNMENT/includes/process.php" method="POST">
                        <input type="hidden" id="delete_username" name="username">
                        <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete Account</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include('footer.php') ?>

    <!-- Bootstrap 4.5.2 JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Populating the edit modal with data
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const field = button.getAttribute('data-field');
                const value = button.getAttribute('data-value');
                const username = button.getAttribute('data-username');

                document.getElementById('field').value = field;
                document.getElementById('value').value = value;
                document.getElementById('username').value = username;
            });
        });

        // Populating the delete modal with the username for deletion
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                const username = button.getAttribute('data-username');
                document.getElementById('delete_username').value = username;
            });
        });
    </script>
</body>
</html>

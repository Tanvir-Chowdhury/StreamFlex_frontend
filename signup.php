<?php
include 'connection.php'; 

$message = ''; 
ob_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate input data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $raw_password = $_POST['password'];

    // Basic validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<div class='alert alert-danger'>Error: Invalid email format.</div>";
    } elseif (empty($phone)) {
        $message = "<div class='alert alert-danger'>Error: Phone number is required.</div>";
    } elseif (empty($raw_password)) {
        $message = "<div class='alert alert-danger'>Error: Password is required.</div>";
    } else {
        // Hash the password
        $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
        
        // Default role for a new user (assuming '2' is for regular users, '1' is for admin)
        $role_id = 2;  // Set default role as '2' for normal users
        
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, phone_number, password_hash, role_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())");

        if ($stmt === false) {
            error_log("Error preparing statement: " . $conn->error);
            $message = "<div class='alert alert-danger'>An unexpected error occurred. Please try again.</div>";
        } else {
            // Bind parameters and execute the query
            $username = $_POST['username'];  // Assuming username is part of the form
            $stmt->bind_param("sssss", $username, $email, $phone, $hashed_password, $role_id);

            if ($stmt->execute()) {
                // Redirect after successful signup
                header("Location: login.php?signup=success");
                exit();
            } else {
                // Handle any errors during query execution
                if ($conn->errno == 1062) {
                    $message = "<div class='alert alert-danger'>Error: This email or phone number is already registered.</div>";
                } else {
                    error_log("Execution failed: " . $stmt->error);
                    $message = "<div class='alert alert-danger'>An error occurred during registration. Please try again.</div>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - StreamFlex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/brand.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <style>

        .form-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border-radius: 0.5rem;
            background-color: #212529; 
            color: white;
        }
        .auth-link {
            color: #0d6efd; 
            text-decoration: none;
        }
        .auth-link:hover {
            text-decoration: underline;
        }
        .divider {
            border-color: #495057;
        }
        .fs-sm {
            font-size: .875rem;
        }
    </style>
</head>
<body style="padding-top: 70px; background-color: #121212;">
    <?php require 'navbar.php'; ?>
    <main class="d-flex align-items-center justify-content-center flex-grow-1 p-3 min-vh-100">
        <div class="form-container">
            <div class="text-center mb-5">
                <h1 class="h3 fw-bold" style="letter-spacing: 1px;">StreamFlex</h1>
                <h2 class="h5 mt-3 fw-normal text-secondary">Create your Account</h2>
            </div>
            
            <?php 
            if (!empty($message)) {
                echo $message;
            }
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label visually-hidden">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label visually-hidden">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                </div>   
                <div class="mb-3">
                    <label for="phone" class="form-label visually-hidden">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label visually-hidden">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button class="btn btn-primary w-100 py-2 my-3" type="submit">Sign Up</button>
            </form> 
            <div class="d-flex align-items-center my-3">
                <hr class="flex-grow-1 divider">
                <span class="px-3 fs-sm text-secondary">OR</span>
                <hr class="flex-grow-1 divider">
            </div>
            <p class="mt-4 text-center text-secondary">
                Already have an account? <a href="login.php" class="auth-link">Log In</a>
            </p>
        </div>
    </main>

    <!-- Footer -->
    <?php require 'footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>

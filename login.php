<?php

include 'connection.php';
// --- PHP LOGIN SCRIPT ---

// 1. START THE SESSION
session_start();

// --- DATABASE CONNECTION (You will need this for cookie auth too) ---
// include 'db_connection.php'; 
// For now, we will simulate database interactions.

// 2. CHECK FOR A "REMEMBER ME" COOKIE
// This happens BEFORE checking for a regular session.
if (isset($_COOKIE['remember_me']) && !isset($_SESSION['user_id'])) {
    list($selector, $validator) = explode(':', $_COOKIE['remember_me']);

    if ($selector && $validator) {
        // --- !!! DATABASE LOGIC FOR COOKIE AUTHENTICATION !!! ---
        // In a real application, you would:
        // a. Prepare a statement to select the token from your `auth_tokens` table based on the $selector.
        // b. Get the hashed validator and user ID from the database.
        // c. Hash the $validator from the cookie using hash('sha256', $validator).
        // d. Compare the two hashes using hash_equals() to prevent timing attacks.
        // e. Check if the token has not expired.

        // --- SIMULATED DATABASE CHECK FOR COOKIE ---
        // This simulates fetching a token from the database.
        $simulated_db_selector = 'a1b2c3d4e5f6';
        $simulated_db_hashed_validator = hash('sha256', 'z9y8x7w6v5u4');
        $simulated_user_id = 1;
        $simulated_expiry_date = time() + (86400 * 30); // 30 days from now

        if ($selector === $simulated_db_selector && hash_equals($simulated_db_hashed_validator, hash('sha256', $validator))) {
            // Token is valid, log the user in.
            $_SESSION['user_id'] = $simulated_user_id;
            $_SESSION['username'] = 'TestUser';
            
            // OPTIONAL (but recommended for security):
            // 1. Generate new selector and validator.
            // 2. Update the token in the database with the new values.
            // 3. Reset the cookie on the user's browser with the new values.
        }
    }
}


// If the user is now logged in (either by session or cookie), redirect them.
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// 3. INITIALIZE VARIABLES
$login_error = '';

// 4. CHECK IF THE FORM HAS BEEN SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 5. GET FORM DATA
    $login_id = $_POST['login-id']; // Can be email or phone
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember-me']);

    // --- !!! IMPORTANT: DATABASE LOGIN LOGIC GOES HERE !!! ---
    $simulated_db_email = 'user@example.com';
    $simulated_db_hashed_password = password_hash('password123', PASSWORD_DEFAULT);
    $simulated_user_id = 1;

    if ($login_id === $simulated_db_email && password_verify($password, $simulated_db_hashed_password)) {
        
        // 6. AUTHENTICATION SUCCESSFUL: SET SESSION VARIABLES
        $_SESSION['user_id'] = $simulated_user_id;
        $_SESSION['username'] = 'TestUser';

        // 7. HANDLE "REMEMBER ME" COOKIE
        if ($remember_me) {
            $selector = bin2hex(random_bytes(16));
            $validator = bin2hex(random_bytes(32));
            $hashed_validator = hash('sha256', $validator);
            $expires = time() + (86400 * 30); // Cookie expires in 30 days

            // --- !!! DATABASE LOGIC FOR STORING TOKEN !!! ---
            // You need a table named `auth_tokens` with columns like:
            // - id (INT, PRIMARY KEY, AUTO_INCREMENT)
            // - selector (CHAR(32), UNIQUE)
            // - hashed_validator (CHAR(64))
            // - user_id (INT, FOREIGN KEY to your users table)
            // - expires (DATETIME or INT)
            //
            // Prepare a statement to INSERT the new token into this table.
            
            // Set the cookie on the user's browser
            setcookie('remember_me', $selector . ':' . $validator, $expires, '/', '', false, true); // Last two params are for secure and httponly flags
        }

        // 8. REDIRECT TO A PROTECTED PAGE
        header('Location: index.php');
        exit();

    } else {
        // 9. AUTHENTICATION FAILED: SET AN ERROR MESSAGE
        $login_error = 'Invalid email or password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - StreamFlex</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <!-- Make sure these CSS paths are correct relative to your PHP file's location -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/brand.css" />
    <style>
        /* Added a simple style for the error message */
        .error-message {
            color: #dc3545; /* Bootstrap's danger color */
            background-color: #f8d7da;
            border: 1px solid #f5c2c7;
            border-radius: 0.25rem;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
  </head>
  <body style="padding-top: 70px">
    <!-- Navbar -->
    <?php require 'navbar.php'; ?>

    <main
      class="d-flex align-items-center justify-content-center flex-grow-1 p-3"
    >
      <div class="form-container">
        <div class="text-center mb-5">
          <h1 class="h3 fw-bold" style="letter-spacing: 1px">StreamFlex</h1>
          <h2 class="h5 mt-3 fw-normal text-secondary">Welcome Back</h2>
        </div>
        
        <!-- The form now submits to itself using the POST method -->
        <form action="login.php" method="post">
        
          <?php 
          // Display the login error message
          if (!empty($login_error)) {
              echo '<div class="error-message">' . htmlspecialchars($login_error) . '</div>';
          }
          ?>
          <div class="mb-3">
            <label for="login-id" class="form-label visually-hidden"
              >Email or Phone</label
            >
            <input
              type="text"
              class="form-control"
              id="login-id"
              name="login-id"
              placeholder="Email or Phone Number"
              required
            />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label visually-hidden"
              >Password</label
            >
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Password"
              required
            />
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember-me">
                <label class="form-check-label text-secondary" for="remember-me" style="font-size: 0.9rem;">
                    Remember Me
                </label>
            </div>
            <a href="resetpassword.html" class="auth-link" style="font-size: 0.9rem;">Forgot Password?</a>
          </div>

          <button class="btn btn-primary w-100 py-2 my-3" type="submit">
            Log In
          </button>
        </form>
        <div class="d-flex align-items-center my-3">
          <hr class="flex-grow-1 divider" />
          <span class="px-3 fs-sm text-tertiary">OR</span>
          <hr class="flex-grow-1 divider" />
        </div>
        <p class="mt-4 text-center text-secondary">
          New to StreamFlex?
          <a href="signup.php" class="auth-link">Sign Up Now</a>
        </p>
      </div>
    </main>
    <!-- Footer -->
    <?php require 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

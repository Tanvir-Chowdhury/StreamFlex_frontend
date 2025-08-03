<?php
session_start();
include 'connection.php';  


if (isset($_COOKIE['remember_me']) && !isset($_SESSION['user_id'])) {
    list($selector, $validator) = explode(':', $_COOKIE['remember_me']);

    if ($selector && $validator) {
        $simulated_db_selector = 'a1b2c3d4e5f6';
        $simulated_db_hashed_validator = hash('sha256', 'z9y8x7w6v5u4');
        $simulated_user_id = 1;
        $simulated_expiry_date = time() + (86400 * 30); // 30 days from now

        if ($selector === $simulated_db_selector && hash_equals($simulated_db_hashed_validator, hash('sha256', $validator))) {
            $_SESSION['user_id'] = $simulated_user_id;
            $_SESSION['username'] = 'TestUser';
        }
    }
}

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_id = $_POST['login-id'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember-me']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone_number = ?");
    $stmt->bind_param("ss", $login_id, $login_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];

            if ($remember_me) {
                $selector = bin2hex(random_bytes(16));
                $validator = bin2hex(random_bytes(32));
                $hashed_validator = hash('sha256', $validator);
                $expires = time() + (86400 * 30); 

                setcookie('remember_me', $selector . ':' . $validator, $expires, '/', '', false, true); 
            }
            if ($user['role_id'] == 1) {
              header('Location: admin_dashboard.php');
              exit();
            }
            else{
              header('Location: user_dashboard.php');
              exit();
            }
        } else {
            $login_error = 'Invalid email/phone or password. Please try again.';
        }
    } else {
        $login_error = 'Invalid email/phone or password. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - StreamFlex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preload" as="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="preload" as="stylesheet" href="css/style.css" />
    <link rel="preload" as="stylesheet" href="css/brand.css" />
    <link rel="preload" as="stylesheet" href="css/navbar.css" />
    <style>
        .error-message {
            color: #dc3545;
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
    <?php require 'navbar.php'; ?>

    <main class="d-flex align-items-center justify-content-center flex-grow-1 p-3">
      <div class="form-container">
        <div class="text-center mb-5">
          <h1 class="h3 fw-bold" style="letter-spacing: 1px">StreamFlex</h1>
          <h2 class="h5 mt-3 fw-normal text-secondary">Welcome Back</h2>
        </div>

        <form action="login.php" method="post">
          <?php 
          if (!empty($login_error)) {
              echo '<div class="error-message">' . htmlspecialchars($login_error) . '</div>';
          }
          ?>
          <div class="mb-3">
            <label for="login-id" class="form-label visually-hidden">Email or Phone</label>
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
            <label for="password" class="form-label visually-hidden">Password</label>
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
    <?php require 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
  </body>
</html>

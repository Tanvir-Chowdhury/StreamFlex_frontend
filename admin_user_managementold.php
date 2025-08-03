<?php
include 'connection.php';

$sql = "SELECT u.user_id, u.username, u.email, u.phone_number, u.created_at, r.role_name
        FROM users u
        INNER JOIN roles r ON u.role_id = r.role_id
        ORDER BY u.created_at DESC"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $users = [];
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Management - StreamFlex</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="preload" as="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="preload" as="stylesheet"
    />

    <link rel="preload" as="stylesheet" href="css/navbar.css" />
    <link rel="preload" as="stylesheet" href="css/index.css" />
    <link rel="preload" as="stylesheet" href="css/brand.css" />
  </head>
  <body style="background-color: var(--bg-primary); color: white">
    
   <!-- Navbar -->
   <?php require 'navbar.php';?>

    <!-- MAIN CONTENT -->
    <div class="container py-5">
      <h2 class="mb-4 fw-semibold text-white text-center">User Management</h2>
      
      <!-- Filters -->
      <div class="d-flex gap-2 mb-4 flex-wrap">
        <select class="form-select bg-dark text-white" style="width: 200px">
          <option selected>All Movies</option>
          <option value="1">Avatar</option>
          <option value="2">Titanic</option>
        </select>
        <select class="form-select bg-dark text-white" style="width: 200px">
          <option selected>All Subscriptions</option>
          <option value="1">Subscribed</option>
          <option value="2">Free</option>
        </select>
        <button class="btn btn-outline-light">Search</button>
      </div>

      <!-- User Table -->
      <div class="table-responsive bg-dark rounded">
        <table class="table table-dark table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Joined</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
  <?php if (count($users) > 0): ?>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?php echo $user['user_id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><span class="badge bg-primary"><?php echo $user['role_name']; ?></span></td>
        <td><?php echo $user['created_at']; ?></td>
        <td>
          <button class="btn btn-sm btn-warning me-1">Block</button>

          <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
            <input type="hidden" name="delete_user_id" value="<?php echo $user['user_id']; ?>">
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="6" class="text-center">No users found.</td>
    </tr>
  <?php endif; ?>
</tbody>

        </table>
      </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: var(--bg-primary); color: var(--text-tertiary);" class="pt-5 pb-3">
      <hr class="mb-4">
      <div class="container">
        <div class="row text-start">
          <div class="col-md-4 mb-4">
            <h5 class="fw-bold text-white">
              Stream<span style="color: var(--brand-purple)">Flex</span>
            </h5>
            <p class="text-secondary mb-0">
              Your ultimate destination for movies and series streaming.
            </p>
          </div>
          <div class="col-md-2 mb-4">
            <h6 class="fw-semibold text-white">Company</h6>
            <ul class="list-unstyled">
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >About Us</a
                >
              </li>
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >Movies</a
                >
              </li>
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >Series</a
                >
              </li>
            </ul>
          </div>
          <div class="col-md-3 mb-4">
            <h6 class="fw-semibold text-white">Support</h6>
            <ul class="list-unstyled">
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >Help Center</a
                >
              </li>
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >Contact Us</a
                >
              </li>
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >Privacy Policy</a
                >
              </li>
            </ul>
          </div>
          <div class="col-md-3 mb-4">
            <h6 class="fw-semibold text-white">Follow Us</h6>
            <ul class="list-unstyled">
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >Facebook</a
                >
              </li>
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >Twitter</a
                >
              </li>
              <li>
                <a style="color: var(--text-tertiary);" href="#" class="text-decoration-none"
                  >Instagram</a
                >
              </li>
            </ul>
          </div>
        </div>
        <hr class="border-secondary" />
        <div class="text-center text-secondary small">
          © 2024 StreamFlex. All rights reserved.
        </div>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
  </body>
</html>

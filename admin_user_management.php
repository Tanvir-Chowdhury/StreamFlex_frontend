<?php
include 'connection.php';

// Handle delete request BEFORE fetching users or outputting HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $user_id_to_delete = intval($_POST['delete_user_id']);

    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id_to_delete);
    $stmt->execute();
    $stmt->close();

    // Redirect to avoid form resubmission on refresh
    header("Location: admin_user_management.php");
    exit();
}

// Fetch users
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <link rel="stylesheet" href="/css/navbar.css" />
  <link rel="stylesheet" href="/css/index.css" />
  <link rel="stylesheet" href="/css/brand.css" />
</head>

<body style="background-color: var(--bg-primary); color: white">

  <!-- Navbar -->
  <?php require 'navbar.php'; ?>

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
                <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><span class="badge bg-primary"><?php echo htmlspecialchars($user['role_name']); ?></span></td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                <td>
                  <button class="btn btn-sm btn-warning me-1">Block</button>

                  <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="delete_user_id" value="<?php echo (int)$user['user_id']; ?>">
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
  <?php require 'footer.php'; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>

</html>

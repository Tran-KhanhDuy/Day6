<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: /DAY6/frontend/index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once(__DIR__ . '/../../dbConnect.php');

    $conn = connectDb();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: /DAY6/frontend/index.php');
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
  <style>
    body {
      background-color: #f5f5f5;
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 bg-white p-4 rounded shadow-sm">
      <h2 class="text-center mb-4">Login</h2>

      <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-center">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" id="username" name="username" class="form-control" required />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" name="password" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>

        <p class="text-center mt-3">Not a member? 
          <a href="/DAY6/frontend/pages/register.php">Register</a>
        </p>
      </form>
    </div>
  </div>

  <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
  <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>
</html>

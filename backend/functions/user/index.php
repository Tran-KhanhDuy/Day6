<?php
session_start();
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

$search = '';
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    $stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ? OR email LIKE ?");
    $like = "%$search%";
    $stmt->bind_param("ss", $like, $like);
} else {
    $stmt = $conn->prepare("SELECT * FROM users");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <?php include_once(__DIR__ . '/../../layout/style.php'); ?>
    <meta charset="UTF-8">
    <title>Users Lst</title>
    
</head>
<body>
  <?php include_once(__DIR__ . '/../../layout/partials/header.php'); ?>

  <div class="container mt-4">
    <div class="row">
      <!--Sidebar -->
      <div class="col-md-3">
        <?php include_once(__DIR__ . '/../../layout/partials/sitebar.php'); ?>
      </div>

      <!--content -->
      <div class="col-md-9">
        <h3 class="mb-4 text-center">Danh sách người dùng</h3>

        <form class="mb-2 d-flex" method="get">
          <input type="text" name="search" class="form-control me-2" placeholder="Tìm theo tên hoặc email..." value="<?php echo htmlspecialchars($search); ?>">
          <button type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
        </form>

        <table class="table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Tên đăng nhập</th> 
              <th>Mật khẩu</th> 
              <th>Email</th>
              <th>Ngày tạo</th> 
              <th>Địa chỉ</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo str_repeat('*', 10); ?></td>
                <td>
                  <?php 
                    $email = $row['email'];
                    $maskedEmail = preg_replace('/^[^@]+/', '*****', $email);
                    echo htmlspecialchars($maskedEmail); 
                  ?>
                </td>
                <td><?php echo $row['create_at']; ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
                <td>
                  <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" 
                    class="btn btn-sm btn-danger" 
                    onclick="return confirm('Bạn có chắc muốn xóa người dùng này?');">
                    Delete
                    </a>
                <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Details</a>    
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div> 
    </div> 
  </div> 
  <?php include_once(__DIR__ . '/../../layout/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../../layout/scripts.php'); ?>
</body>
</html>

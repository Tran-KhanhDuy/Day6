<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

if (!isset($_GET['id'])) {
    echo "Không có ID người dùng!";
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows !== 1) {
    echo "Không tìm thấy người dùng!";
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h4 class="mb-4 text-center">Edit</h4>

        <form action="processEdit.php" method="post"> 
          <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

          <div class="mb-3"> 
            <label for="username" class="form-label">Tên đăng nhập</label> 
            <input name="username" id="username" type="text" class="form-control" required value="<?php echo htmlspecialchars($user['username']); ?>" /> 
          </div> 

          <div class="mb-3"> 
            <label for="email" class="form-label">Email</label> 
            <input name="email" id="email" type="email" class="form-control" required value="<?php echo htmlspecialchars($user['email']); ?>" /> 
          </div> 

          <div class="mb-3"> 
            <label for="address" class="form-label">Địa chỉ</label>       
            <input name="address" id="address" type="text" class="form-control" value="<?php echo htmlspecialchars($user['address']); ?>" /> 
          </div> 

          <div class="text-center"> 
            <input type="submit" value="Cập nhật" class="btn btn-success" />       
          </div> 
        </form> 
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

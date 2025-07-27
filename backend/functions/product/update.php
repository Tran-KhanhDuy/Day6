<?php
include_once(__DIR__ . '/dbConnect.php');
$conn = connectDb();

$id = intval($_GET['id']);
$sql = "SELECT * FROM product WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Sản phẩm không tồn tại!";
    exit;
}

$product = $result->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center mb-4">Chỉnh sửa sản phẩm</h2>

    <form action="processUpdate.php" method="post" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm:</label>
            <input type="text" class="form-control" name="name" value="<?= $product['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá:</label>
            <input type="text" class="form-control" name="price" value="<?= $product['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục:</label>
            <input type="text" class="form-control" name="category" value="<?= $product['category'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Đường dẫn ảnh:</label>
            <input type="text" class="form-control" name="image_url" value="<?= $product['image_url'] ?>">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
    </form>
</div>

</body>
</html>

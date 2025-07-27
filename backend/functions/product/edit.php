<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Thiếu ID sản phẩm.");
}

// Lấy dữ liệu sản phẩm từ DB
$sql = "SELECT * FROM product WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows !== 1) {
    die("Không tìm thấy sản phẩm.");
}

$product = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Cập nhật sản phẩm</title>
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4 text-center">Chỉnh sửa sản phẩm</h3>
    <form action="processEdit.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input name="name" type="text" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input name="price" type="number" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <input name="category" type="text" class="form-control" value="<?= htmlspecialchars($product['category']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Đường dẫn ảnh</label>
            <input name="image_url" type="text" class="form-control" value="<?= htmlspecialchars($product['image_url']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Số lượng kho</label>
            <input name="stock_quantity" type="number" class="form-control" value="<?= htmlspecialchars($product['stock_quantity']) ?>" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
    </form>
</div>
</body>
</html>

<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM product WHERE id = $id";
    if ($conn->query($sql)) {
        header('Location: /DAY5/backend/functions/product/index.php');
        exit();
    } else {
        echo "Lỗi khi xóa: " . $conn->error;
    }
} else {
    echo "Không tìm thấy ID cần xóa.";
}
?>

<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

   
    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql)) {
        
        header('Location: index.php');
        exit();
    } else {
        echo "Lỗi khi xóa người dùng: " . $conn->error;
    }
} else {
    echo "Không tìm thấy ID người dùng cần xóa.";
}
?>
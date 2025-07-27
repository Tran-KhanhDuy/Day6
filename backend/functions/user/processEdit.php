<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    $sql = "UPDATE users SET username = ?, email = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $username, $email, $address, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật người dùng: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Phương thức không hợp lệ.";
}
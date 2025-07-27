<?php
include_once(__DIR__ . '/dbConnect.php');

$conn = connectDb(); 


$id       = intval($_POST['id']);
$name     = $_POST['name'];
$price    = $_POST['price'];
$category = $_POST['category'];
$image    = $_POST['image_url']; 

$sql = "UPDATE product SET 
            name = '$name',
            price = '$price',
            category = '$category',
            image_url = '$image'
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header('Location: dashboard.php');
} else {
    echo "Lỗi cập nhật: " . $conn->error;
}

$conn->close();

<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();


$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$image_url = $_POST['image_url'];
$description = $_POST['description'];
$stock_quantity = $_POST['stock_quantity'];


$create_at = date('Y-m-d H:i:s');

$sql = "INSERT INTO product (name, price, category, image_url, description, stock_quantity, create_at) 
        VALUES ('$name', '$price', '$category', '$image_url', '$description', '$stock_quantity', '$create_at')";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php'); 
    exit;
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();

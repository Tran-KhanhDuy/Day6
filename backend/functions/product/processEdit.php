<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$image_url = $_POST['image_url'];
$description = $_POST['description'];
$stock_quantity = $_POST['stock_quantity'];

$sql = "UPDATE product 
        SET name = '$name',
            price = '$price',
            category = '$category',
            image_url = '$image_url',
            description = '$description',
            stock_quantity = '$stock_quantity'
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
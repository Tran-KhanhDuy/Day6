<?php
session_start();
include_once(__DIR__ . '/../../dbConnect.php');

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image_url = $_POST['image'];
$quantity = 1;

$total = $price * $quantity;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

if (isset($cart[$id])) {
    $cart[$id]['quantity'] += 1;
    $cart[$id]['subTotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
} else {
    $cart[$id] = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity,
        'image_url' =>  $image_url,
        'subTotal' => $total
    ];
}

$_SESSION['cart'] = $cart;

echo json_encode(['status' => 'success', 'message' => 'Đã thêm vào giỏ hàng']);

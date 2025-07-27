<?php
session_start();
 include_once(__DIR__ . '/../../dbConnect.php');
 $conn = connectDb();


if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: checkout.php?error=empty_cart');
    exit;
}

$userId = $_SESSION['user_id'] ?? 1;
$shipping_address = $_POST['shipping_address'] ?? 'Địa chỉ không xác định';
$totalAmount = 0;

foreach ($_SESSION['cart'] as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

$stmtOrder = $conn->prepare("INSERT INTO orders (user_id, total_amount, status, order_date, shipping_address) VALUES (?, ?, 'Pending', NOW(), ?)");
$stmtOrder->bind_param("ids", $userId, $totalAmount, $shipping_address);
$stmtOrder->execute();

$orderId = $stmtOrder->insert_id; 


$stmtItem = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_at_time) VALUES (?, ?, ?, ?)");

foreach ($_SESSION['cart'] as $productId => $item) {
    $quantity = $item['quantity'];
    $price = $item['price'];
    $stmtItem->bind_param("iiid", $orderId, $productId, $quantity, $price);
    $stmtItem->execute();
}


unset($_SESSION['cart']);

header('Location: checkout.php?order=success');
exit;

<?php
session_start();
include_once(__DIR__ . '/../../dbConnect.php'); 

$customer_name = $_POST['customer_name'] ?? 'Khách lẻ';
$payment_method = $_POST['payment_method'] ?? 'card';
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo json_encode(['status' => 'error', 'message' => 'Giỏ hàng trống!']);
    exit;
}

$total_amount = 0;
foreach ($cart as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

$conn = connectDb();

$stmt = $conn->prepare("INSERT INTO orders (customer_name, total_amount, payment_method, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sds", $customer_name, $total_amount, $payment_method);
$stmt->execute();
$order_id = $stmt->insert_id;

$stmt_detail = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
foreach ($cart as $item) {
    $stmt_detail->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
    $stmt_detail->execute();
}

unset($_SESSION['cart']);

echo json_encode([
    'status' => 'success',
    'message' => 'Đặt hàng thành công!',
    'order_id' => $order_id
]);
?>

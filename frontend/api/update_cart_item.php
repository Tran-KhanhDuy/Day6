<?php
session_start();
header('Content-Type: application/json'); 

include_once(__DIR__ . '/../../dbConnect.php');

$id = $_POST['id'] ?? null;
$quantity = $_POST['quantity'] ?? null;


if (!$id || !$quantity || !is_numeric($quantity) || $quantity <= 0) {
    echo json_encode(['error' => 'Invalid ID or quantity']);
    exit;
}


if (isset($_SESSION['cart'][$id])) {
    $tmpProd = $_SESSION['cart'][$id];
    $_SESSION['cart'][$id] = [
        'id' => $tmpProd['id'],
        'name' => $tmpProd['name'],
        'price' => $tmpProd['price'],
        'quantity' => $quantity,
        'image' => $tmpProd['image'],
        'subTotal' => $tmpProd['price'] * $quantity,
    ];

    echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
} else {
    echo json_encode(['error' => 'Product not found in cart']);
}

<?php
session_start();
    include_once(__DIR__ . '/../../dbConnect.php');


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$conn = connectDb();

$sql = "SELECT id, total_amount, status, order_date, shipping_address 
        FROM orders 
        WHERE user_id = ? 
        ORDER BY order_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8" />
<title>Your order history</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

  <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

<div class="container mt-5">
    <h2>Your order history</h2>
    <?php if (count($orders) === 0): ?>
        <div class="alert alert-info">You have no orders yet.</div>
        <a href="/DAY6/frontend/index.php" class="btn btn-primary">Continue shopping</a>
    <?php else: ?>
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>order_date</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['id']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                    <td><?= htmlspecialchars($order['shipping_address']) ?></td>
                    <td><?= number_format($order['total_amount'], 0, ',', '.') ?> đ</td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td>
                        <a href="order_detail_view.php?order_id=<?= urlencode($order['id']) ?>" class="btn btn-sm btn-info">
                            Check
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

  <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>

</body>
</html>

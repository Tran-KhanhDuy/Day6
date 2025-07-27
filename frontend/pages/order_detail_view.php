<?php
session_start();
include_once(__DIR__ . '/../../dbConnect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$order_id = $_GET['order_id'] ?? null;
$user_id = $_SESSION['user_id'];

if (!$order_id) {
    echo "<script>alert('Thiếu mã đơn hàng.'); window.location.href='history.php';</script>";
    exit;
}

$conn = connectDb();

$sql_check = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ii", $order_id, $user_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows === 0) {
    echo "<script>alert('Không tìm thấy đơn hàng.'); window.location.href='history.php';</script>";
    exit;
}
$stmt_check->close();

$sql_detail = "SELECT oi.*, p.name AS item_name 
               FROM order_items oi 
               JOIN product p ON oi.product_id = p.id 
               WHERE oi.order_id = ?";
$stmt = $conn->prepare($sql_detail);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

if (empty($order_items)) {
    echo "<script>alert('Đơn hàng không có sản phẩm nào.'); window.location.href='history.php';</script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #order-details {
      display: none;
      animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .spinner-wrapper svg {
      animation: rotate 1.5s linear infinite;
    }

    @keyframes rotate {
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

<div class="container text-center my-5">
  <!-- Loading -->
  <div id="loading">
    <div class="spinner-wrapper mb-3">
      <svg width="80" height="80" viewBox="0 0 100 100" fill="#007bff" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="35" stroke-width="10" stroke="#e0e0e0" fill="none"/>
        <circle cx="50" cy="50" r="35" stroke-width="10" stroke="#007bff" fill="none"
                stroke-dasharray="164.93361431346415" stroke-dashoffset="0">
          <animateTransform attributeName="transform" type="rotate" from="0 50 50"
                            to="360 50 50" dur="1.5s" repeatCount="indefinite"/>
        </circle>
      </svg>
    </div>
    <p><strong>Vui lòng đợi 5 giây</strong></p>
  </div>

  <!-- Order Details -->
  <div id="order-details">
    <h3>Information order #<?= htmlspecialchars($order_id) ?></h3>
    <table class="table table-bordered mt-3">
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($order_items as $item): ?>
          <tr>
            <td><?= htmlspecialchars($item['item_name']) ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><?= number_format($item['price_at_time'], 0, ',', '.') 
            ?> VND</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="history.php" class="btn btn-primary mt-3">
      <i class="fa fa-arrow-left me-1"></i> Return
    </a>
  </div>
</div>

<script>
  setTimeout(() => {
    document.getElementById("loading").style.display = "none";
    document.getElementById("order-details").style.display = "block";
  }, 5000);
</script>

</body>
</html>

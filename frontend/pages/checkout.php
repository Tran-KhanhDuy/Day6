<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    svg.animate-spin {
      animation: rotate 1.5s linear infinite;
    }
    @keyframes rotate {
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

<?php include_once(__DIR__ . '/../../frontend/layouts/partials/header.php'); ?>

<div class="container my-5">

  <?php if (isset($_GET['order']) && $_GET['order'] == 'success'): ?>
    <div class="alert alert-success text-center">
      Your order has been placed successfully!
    </div>
    <div class="text-center">
      <svg width="40" height="40" viewBox="0 0 100 100" class="animate-spin my-3" xmlns="http://www.w3.org/2000/svg" fill="#007bff">
        <circle cx="50" cy="50" r="35" stroke-width="10" stroke="#e0e0e0" fill="none" />
        <circle cx="50" cy="50" r="35" stroke-width="10" stroke="#007bff" fill="none"
                stroke-dasharray="164.93361431346415"
                stroke-dashoffset="0" />
      </svg>
      <p class="text-muted">Redirecting to payment page...</p>
      <a href="/DAY6/frontend/index.php" class="btn btn-primary">Continue shopping</a>
    </div>

    <script>
      setTimeout(function() {
        window.location.href = 'payment.php';
      }, 3000); 
    </script>

  <?php elseif (empty($_SESSION['cart'])): ?>
    <div class="text-center my-5">
      <svg width="80" height="80" viewBox="0 0 100 100" class="mb-3 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="#007bff">
        <circle cx="50" cy="50" r="35" stroke-width="10" stroke="#e0e0e0" fill="none" />
        <circle cx="50" cy="50" r="35" stroke-width="10" stroke="#007bff" fill="none"
                stroke-dasharray="164.93361431346415"
                stroke-dashoffset="0" />
      </svg>
      <p class="mt-3 text-muted fs-5">You have no products in your shopping cart..</p>
      <a href="/DAY6/frontend/index.php" class="btn btn-primary">
        <i class="fa fa-arrow-left me-1"></i> Tiếp tục mua sắm
      </a>
    </div>

  <?php else: ?>
    <h2 class="mb-4">Order information</h2>

    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>TotalMoney</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total = 0;
          foreach ($_SESSION['cart'] as $item):
            $itemTotal = $item['price'] * $item['quantity'];
            $total += $itemTotal;
        ?>
          <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= number_format($item['price']) ?> đ</td>
            <td><?= $item['quantity'] ?></td>
            <td><?= number_format($itemTotal) ?> đ</td>
          </tr>
        <?php endforeach; ?>
        <tr class="fw-bold">
          <td colspan="3" class="text-end">Total</td>
          <td><?= number_format($total) ?> đ</td>
        </tr>
      </tbody>
    </table>

    <form action="ProcessCheckout.php" method="POST">
      <div class="mb-3">
        <label for="shipping_address" class="form-label">Delivery address</label>
        <input type="text" name="shipping_address" id="shipping_address" class="form-control" required>
      </div>
      <div class="text-end">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-check me-1"></i> Order confirmation
        </button>
      </div>
    </form>

  <?php endif; ?>

</div>

<?php include_once(__DIR__ . '/../../frontend/layouts/partials/footer.php'); ?>
</body>
</html>

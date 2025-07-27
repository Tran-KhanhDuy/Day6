<?php
include_once(__DIR__ . '/dbConnect.php');
$conn = connectDb();
$sql = "SELECT * FROM product ORDER BY id DESC LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang chủ</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <?php include_once(__DIR__ . '/layout/style.php'); ?>
</head>
<body>

    <?php include_once(__DIR__ . '/layout/partials/header.php'); ?>
  <!-- Carousel -->
  <div class="container mt-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <?php include_once(__DIR__ . '/layout/partials/sitebar.php'); ?>
    </div>

    <!-- Carousel -->
    <div class="col-md-9">
      <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../assets/slides/hinh1.jpg" class="d-block w-100" alt="Slide 1">
          </div>
          <div class="carousel-item">
            <img src="../assets/slides/hinh2.jpg" class="d-block w-100" alt="Slide 2">
          </div>
          <div class="carousel-item">
            <img src="../assets/slides/hinh3.jpg" class="d-block w-100" alt="Slide 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </div>
</div>

  <!-- Features -->
  <div class="container marketing mt-5">
    <div class="row text-center mb-4">
      <div class="col-lg-4">
        <i class="fa fa-credit-card fa-3x mb-3 text-primary"></i>
        <h2>Thanh toán dễ dàng</h2>
        <p>Hỗ trợ nhiều hình thức như QR, ví điện tử, thẻ tín dụng.</p>
      </div>
      <div class="col-lg-4">
        <i class="fa fa-shield-halved fa-3x mb-3 text-success"></i>
        <h2>Bảo mật cao</h2>
        <p>Mọi giao dịch đều được mã hóa, an toàn tuyệt đối.</p>
      </div>
      <div class="col-lg-4">
        <i class="fa fa-headset fa-3x mb-3 text-danger"></i>
        <h2>Hỗ trợ 24/7</h2>
        <p>Đội ngũ chăm sóc khách hàng sẵn sàng phục vụ bạn.</p>
      </div>
    </div>
  </div>

  <!-- Latest Products -->
  <div class="container my-5">
    <h2 class="text-center mb-4">Sản phẩm mới nhất</h2>
    <div class="row">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <a href="/DAY5/frontend/pages/details.php?id=<?php echo $row['id']; ?>">
              <img src="/DAY5/assets/<?php echo htmlspecialchars($row['image_url']); ?>" 
                   class="card-img-top" 
                   alt="<?php echo htmlspecialchars($row['name']); ?>">
            </a>
            <div class="card-body">
              <h5 class="card-title">
                <a href="/DAY5/frontend/pages/details.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark">
                  <?php echo htmlspecialchars($row['name']); ?>
                </a>
              </h5>
              <p class="card-text text-muted"><?php echo htmlspecialchars($row['description']); ?></p>
              <p class="card-text fw-bold text-danger">
                <?php echo number_format($row['price'], 0, ',', '.') ?> đ
              </p>
            </div>
            <div class="card-footer bg-transparent border-top-0 text-center">
              <a href="/DAY5/frontend/pages/details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-secondary w-100 mb-2">Chi tiết</a>
              <a href="#" class="btn btn-primary w-100">Thêm vào giỏ</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

<?php include_once(__DIR__ . '/layout/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/layout/scripts.php'); ?></body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DashBoard</title>

  <?php include_once(__DIR__ . '/../../layout/style.php'); ?>
</head>
<body>

  <?php include_once(__DIR__ . '/../../layout/partials/header.php'); ?>

  <div class="container mt-4">
    <div class="row">
      
      <!-- Sidebar -->
      <div class="col-md-3">
        <?php include_once(__DIR__ . '/../../layout/partials/sitebar.php'); ?>
      </div>

      <!-- Main content -->
      <div class="col-md-9">
        <h3 class="mb-4 text-center">Product List</h3>
        <a href="/DAY5/backend/functions/product/create.php" class="btn btn-success mb-3">Create Product</a>

        <?php
          include_once(__DIR__ . '/../../dbConnect.php');
          $conn = connectDb();
          $sql = "SELECT * FROM product ORDER BY id DESC LIMIT 6";
          $result = $conn->query($sql);
        ?>

        <div class="row">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm">
                <img src="/DAY5/assets/<?php echo htmlspecialchars($row['image_url']); ?>" 
                     class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                  <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                  <p class="card-text fw-bold text-danger"><?php echo number_format($row['price'], 0, ',', '.') ?> đ</p>
                </div>
                <div class="card-footer bg-transparent text-center">
                  <a href="/DAY5/backend/functions/product/edit.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary w-100 mb-2">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="/DAY5/backend/functions/product/delete.php?id=<?php echo $row['id']; ?>"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');"
                    class="btn btn-outline-danger w-100">
                    <i class="fas fa-trash"></i> Delete
                  </a>
                  <a href="/DAY5/backend/functions/product/detail.php?id=<?php echo $row['id']; ?>" 
                    class="btn btn-outline-info w-100 mb-2">
                    <i class="fas fa-info-circle"></i> Detail
                    </a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div> 
    </div> 
  </div> 
<?php include_once(__DIR__ . '/../../layout/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../../layout/scripts.php'); ?>
</body>
</html>

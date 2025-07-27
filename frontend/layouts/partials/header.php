<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Carousel Template · Bootstrap v5.3</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .carousel-caption {
      bottom: 3rem;
      z-index: 10;
    }

    .carousel-item {
      height: 32rem;
      background-color: #777;
      color: white;
      position: relative;
      text-align: center;
    }

    .carousel-item > img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 32rem;
      object-fit: cover;
      opacity: 0.6;
    }
  </style>
</head>
<body>
<header>
    

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">demoshop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
          <li class="nav-item"><a class="nav-link disabled">Disabled</a></li>
        </ul>
        <div class="d-flex align-items-center me-3">
       
        
</div>
        <div class="d-flex align-items-center me-3">
  <a href="/DAY6/frontend/pages/viewCart.php" 
     id="cart-icon" 
     class="text-white text-decoration-none position-relative">
     
    <i class="fas fa-shopping-cart fa-lg"></i>

    <?php
      $cartCount = 0;
      if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
          $cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
      }
    ?>

    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      <?= $cartCount ?>
    </span>
  </a>
</div>
                <div class="d-flex align-items-center">
        <?php if (isset($_SESSION['user_id'])): ?>
          <span class="text-white me-3">Hello<?= htmlspecialchars($_SESSION['username']) ?></span>
          <a href="/DAY6/frontend/pages/logout.php" class="btn btn-outline-light">Logout</a>
        <?php else: ?>
          <a href="/DAY6/frontend/pages/login.php" class="btn btn-outline-light">Login</a>
        <?php endif; ?>
      </div>
    <?php if (isset($_SESSION['user_id'])): ?>
  <a href="/DAY6/frontend/pages/History.php" class="btn btn-outline-warning ms-2">Lịch sử đặt</a>
<?php endif; ?>
      <form class="d-flex ms-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
      </div>
    </div>
  </nav>
</header>
<main>

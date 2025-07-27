<nav class="col-md-2 d-none d-md-block bg-light sidebar" style="min-height: 100vh;">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <!-- Admin Section -->
      <li class="nav-item">
        <span class="nav-link disabled fw-bold text-uppercase text-secondary">Admin</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/DAY5/backend/pages/dashboard.php">
          Dashboard
        </a>
      </li>
      <hr style="border: 1px solid red; width: 80%;" />

      <!-- Product Section -->
      <li class="nav-item">
        <span class="nav-link disabled fw-bold text-uppercase text-secondary">Product</span>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
          Product
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/DAY5/backend/functions/product/index.php">Product List</a></li>
          <li><a class="dropdown-item" href="/DAY5/backend/functions/product/create.php">Create</a></li>
        </ul>
      </li>

      <!-- User Section -->
      <li class="nav-item mt-3">
        <span class="nav-link disabled fw-bold text-uppercase text-secondary">User</span>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
          User
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/DAY5/backend/functions/user/index.php">User List</a></li>
          <li><a class="dropdown-item" href="/DAY5/backend/functions/user/create.php">Create</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

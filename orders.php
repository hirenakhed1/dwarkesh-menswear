<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Orders - Dwarkesh Menswear</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <style>
    body { background-color: #111; color: #fff; }
    .form-control, .table { background-color: #222; color: #fff; }
    .btn-gold {
      background-color: #d4af37;
      color: #000;
      font-weight: 600;
    }
    .btn-gold:hover {
      background-color: #c49b2f;
      color: #fff;
    }
    .table th, .table td { vertical-align: middle; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.html">
      <i class="fas fa-tshirt me-2"></i>Dwarkesh Menswear
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="orders.php">Orders</a></li>
        <li class="nav-item"><a class="nav-link" href="reviews.php">Reviews</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link" href="features.html">Size Chart</a></li>
      </ul>
      <div class="ms-3">
        <a href="admin/login.php" class="btn btn-gold btn-sm">
          <i class="fas fa-user-shield me-2"></i>Admin Login
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Order Lookup Section -->
<div class="container py-5 mt-5">
  <h2 class="text-center text-gold mb-4">Check Your Orders</h2>
  <form method="GET" class="row justify-content-center mb-5">
    <div class="col-md-4 mb-2">
      <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
    </div>
    <div class="col-md-4 mb-2">
      <input type="text" name="phone" class="form-control" placeholder="Enter your phone" required>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-gold w-100">View Orders</button>
    </div>
  </form>

  <?php
  if (isset($_GET['name']) && isset($_GET['phone'])) {
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $phone = mysqli_real_escape_string($conn, $_GET['phone']);

    $orders = mysqli_query($conn, "SELECT * FROM orders WHERE customer_name='$name' AND phone='$phone' ORDER BY id DESC");

    if (mysqli_num_rows($orders) > 0) {
      echo '<div class="table-responsive"><table class="table table-dark table-striped">';
      echo '<thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Status</th><th>Date</th></tr></thead><tbody>';
      while ($order = mysqli_fetch_assoc($orders)) {
        echo "<tr>
          <td>{$order['product_name']}</td>
          <td>{$order['product_category']}</td>
          <td>₹{$order['product_price']}</td>
          <td><span class='badge ".($order['status'] == 'Placed' ? 'bg-success' : 'bg-warning')."'>{$order['status']}</span></td>
          <td>{$order['created_at']}</td>
        </tr>";
      }
      echo '</tbody></table></div>';
    } else {
      echo "<div class='text-center text-danger'>No orders found for this user.</div>";
    }
  }
  ?>
</div>

<!-- Footer -->
<footer class="footer-section bg-black text-light py-4">
  <div class="container text-center">
    <p>&copy; 2025 Dwarkesh Menswear. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

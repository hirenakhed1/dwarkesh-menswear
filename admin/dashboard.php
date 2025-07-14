<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: #0a0a0a;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    h2 {
      color: #ffd700;
      font-weight: 700;
      margin-bottom: 2rem;
    }
    .dashboard-section {
      background: #1a1a1a;
      border: 1px solid #333;
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 25px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dashboard-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(255, 215, 0, 0.2);
    }
    .dashboard-section h4 {
      color: #ffd700;
      margin-bottom: 1rem;
    }
    .btn-dashboard {
      width: 100%;
      padding: 12px;
      margin-bottom: 10px;
      font-weight: 600;
      border-radius: 8px;
    }
    .btn-dashboard i {
      margin-right: 8px;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <h2 class="text-center">Welcome, Admin</h2>

    <div class="row">
      <div class="col-md-4">
        <div class="dashboard-section">
          <h4><i class="fas fa-plus-circle"></i> Product Management</h4>
          <a href="add-product.php" class="btn btn-warning btn-dashboard"><i class="fas fa-plus"></i>Add Product</a>
          <a href="delete-product.php" class="btn btn-danger btn-dashboard"><i class="fas fa-trash"></i>Delete Product</a>
          <a href="update-product.php" class="btn btn-info btn-dashboard"><i class="fas fa-pen"></i>Update Product</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="dashboard-section">
          <h4><i class="fas fa-box"></i> Orders</h4>
          <a href="manage-orders.php" class="btn btn-primary btn-dashboard"><i class="fas fa-shopping-cart"></i>Manage Orders</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="dashboard-section">
          <h4><i class="fas fa-star"></i> Reviews</h4>
          <a href="manage-reviews.php" class="btn btn-success btn-dashboard"><i class="fas fa-comments"></i>Manage Reviews</a>
        </div>

        <div class="dashboard-section mt-4">
          <h4><i class="fas fa-sign-out-alt"></i> Logout</h4>
          <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')" class="btn btn-secondary btn-dashboard"><i class="fas fa-arrow-left"></i>Logout to Website</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

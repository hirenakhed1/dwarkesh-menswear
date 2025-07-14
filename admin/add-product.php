<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $stock = $_POST['stock'] ?? 0;

  $sql = "INSERT INTO products (name, category, price, image, stock, likes) 
          VALUES ('$name', '$category', '$price', '$image', '$stock', 0)";

  if (mysqli_query($conn, $sql)) {
    $message = "✅ Product added successfully!";
  } else {
    $message = "❌ Error: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container my-5">
  <h2>Add New Product</h2>

  <?php if ($message) echo "<div class='alert alert-info'>$message</div>"; ?>

  <form method="POST">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Category</label>
      <select name="category" class="form-control" required>
        <option value="shirt">Shirt</option>
        <option value="pant">Pant</option>
        <option value="tshirt">T-Shirt</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Price</label>
      <input type="number" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Image URL</label>
      <input type="text" name="image" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Stock</label>
      <select name="stock" class="form-control">
        <option value="1">Available</option>
        <option value="0">Out of Stock</option>
      </select>
    </div>
    <button class="btn btn-warning">Add Product</button>
  </form>

  <a href="dashboard.php" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a>
</div>
</body>
</html>

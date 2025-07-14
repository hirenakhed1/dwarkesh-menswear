<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM products WHERE id=$id");
  header("Location: delete-product.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container my-5">
  <h2>Delete Products</h2>
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM products");
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
          <td>{$row['id']}</td>
          <td>{$row['name']}</td>
          <td>{$row['category']}</td>
          <td>₹{$row['price']}</td>
          <td>".($row['stock'] ? "Available" : "Out of Stock")."</td>
          <td><a href='delete-product.php?delete={$row['id']}' class='btn btn-danger btn-sm'>Delete</a></td>
        </tr>";
      }
      ?>
    </tbody>
  </table>
  <a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>
</div>
</body>
</html>

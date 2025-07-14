<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $stock = $_POST['stock'];
  mysqli_query($conn, "UPDATE products SET stock=$stock WHERE id=$id");
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container my-5">
  <h2>Update Stock</h2>
  <table class="table table-dark table-bordered">
    <thead>
      <tr><th>ID</th><th>Name</th><th>Category</th><th>Stock</th><th>Action</th></tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <form method="POST">
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['category'] ?></td>
            <td>
              <select name="stock" class="form-control">
                <option value="1" <?= $row['stock'] ? 'selected' : '' ?>>Available</option>
                <option value="0" <?= !$row['stock'] ? 'selected' : '' ?>>Out of Stock</option>
              </select>
            </td>
            <td>
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button name="update" class="btn btn-warning btn-sm">Update</button>
            </td>
          </form>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>
</div>
</body>
</html>

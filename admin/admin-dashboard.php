<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dwarkesh Menswear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
        }
        .btn-gold {
            background-color: #d4af37;
            color: #000;
            font-weight: 600;
        }
        .btn-gold:hover {
            background-color: #c49b2f;
            color: #fff;
        }
        .card {
            background-color: #2a2a2a;
            border: 1px solid #444;
        }
        .form-control, .form-select {
            background-color: #333;
            color: #fff;
            border: 1px solid #666;
        }
        .form-control:focus, .form-select:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
        }
        .table-dark th, .table-dark td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Dashboard</h2>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>

    <!-- Add Product Form -->
    <div class="card mb-4">
        <div class="card-header text-gold">Add New Product</div>
        <div class="card-body">
            <form action="add-product.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="price" class="form-control" placeholder="Price" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-select" required>
                            <option value="shirt">Shirt</option>
                            <option value="pant">Pant</option>
                            <option value="tshirt">T-Shirt</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="image" class="form-control" placeholder="Image URL" required>
                    </div>
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-gold">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Table -->
    <div class="card">
        <div class="card-header text-gold">Current Products</div>
        <div class="card-body">
            <table class="table table-dark table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>₹{$row['price']}</td>";
                    echo "<td>{$row['stock']}</td>";
                    echo "<td>{$row['category']}</td>";
                    echo "<td><img src='{$row['image']}' alt='img' width='60'></td>";
                    echo "<td>
                            <a href='update-product.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete-product.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure to delete this product?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

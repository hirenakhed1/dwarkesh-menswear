<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #1a1a1a;
            color: #f1f1f1;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            background-color: #2a2a2a;
            border: 1px solid #444;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #fff;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.2);
        }
        .btn-status {
            font-size: 0.85rem;
            white-space: nowrap;
        }
        .badge-status {
            padding: 5px 10px;
            font-size: 0.9rem;
            border-radius: 5px;
        }
        .badge-placed { background-color: #ffc107; color: black; }
        .badge-pending { background-color: #0dcaf0; }
        .badge-completed { background-color: #28a745; }
        h5.text-warning {
            font-size: 1.2rem;
        }
        .form-select, .btn {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4 text-center">📦 Manage Orders</h2>
    <div class="row g-4">
        <?php
        $orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($orders)) {
            $badgeClass = match($row['status']) {
                'Placed' => 'badge-placed',
                'Pending' => 'badge-pending',
                'Completed' => 'badge-completed',
                default => 'bg-secondary'
            };
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="card p-3 h-100">
                    <h5 class="text-warning"><?= htmlspecialchars($row['product_name']) ?></h5>
                    <p>
                        <strong>Customer:</strong> <?= htmlspecialchars($row['customer_name']) ?><br>
                        <strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?><br>
                        <strong>Category:</strong> <?= htmlspecialchars($row['product_category']) ?><br>
                        <strong>Price:</strong> ₹<?= htmlspecialchars($row['product_price']) ?><br>
                        <strong>Address:</strong><br><?= nl2br(htmlspecialchars($row['address'])) ?>
                    </p>
                    <p>
                        <strong>Status:</strong> 
                        <span class="badge <?= $badgeClass ?>"><?= $row['status'] ?></span>
                    </p>

                    <!-- Update Status Form -->
                    <form action="update-order-status.php" method="POST" class="d-flex gap-2 mb-2">
                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="Placed" <?= $row['status'] == 'Placed' ? 'selected' : '' ?>>Placed</option>
                            <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Completed" <?= $row['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                        </select>
                        <button type="submit" name="update" class="btn btn-sm btn-warning btn-status">Update</button>
                    </form>

                    <!-- Delete Form -->
                    <form action="delete-order.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Delete this order?')">Delete</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>

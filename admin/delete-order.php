<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $delete = mysqli_query($conn, "DELETE FROM orders WHERE id=$order_id");

    header("Location: manage-orders.php");
    exit();
}
?>

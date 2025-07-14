<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Get image from products table
    $product_image = ''; // fetch image from products table using product_name
$imgResult = mysqli_query($conn, "SELECT image FROM products WHERE name='$product_name' LIMIT 1");
if ($imgRow = mysqli_fetch_assoc($imgResult)) {
    $image = $imgRow['image'];
}

$sql = "INSERT INTO orders (product_name, product_price, product_category, customer_name, phone, address, status, image)
        VALUES ('$product_name', '$product_price', '$product_category', '$customer_name', '$phone', '$address', 'Placed', '$image')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Order placed successfully!'); window.location.href='orders.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

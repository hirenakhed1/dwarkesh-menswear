<?php
// $conn = mysqli_connect("localhost", "root", "", "dwar_db");

// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

$conn = mysqli_connect(
    "mysql.railway.internal",       // Host
    "root",                         // Username
    "XBmbaFsqkgupVbZUKBgEYbzTXaYZqPdb", // Password
    "railway",                      // Database name
    3306                            // Port
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

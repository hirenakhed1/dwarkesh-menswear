<?php
// $conn = mysqli_connect("localhost", "root", "", "dwar_db");

// if (!$conn) {
//   mysql.railway.internal  die("Connection failed: " . mysqli_connect_error());
// }

$conn = mysqli_connect(
    "mysql://root:XBmbaFsqkgupVbZUKBgEYbzTXaYZqPdb@yamabiko.proxy.rlwy.net:58186/railway",       // Host
    "root",                         // Username
    "XBmbaFsqkgupVbZUKBgEYbzTXaYZqPdb", // Password
    "railway",                      // Database name
    3306                            // Port
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<?php
// Database configuration in localhost

$servername = "127.0.0.1";
// $servername = "10.10.10.235";

$username = "root";

$password = "920511";
// $password = "net,admin168";

$dbname = "nmu";

$dbport = "3306";
// $dbport = "15211";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $dbport);
mysqli_set_charset($conn, "utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 ?>

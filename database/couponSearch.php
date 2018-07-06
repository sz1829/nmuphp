<?php include('dbConnection.php');

$couponCode = $_POST['couponCode'];
$couponValue = "";
$couponStatus = "";
$query = "SELECT discount, code_expired FROM CouponCode WHERE code = '$couponCode'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $couponValue = $row['discount'];
        $couponStatus = $row['code_expired'];
    }
}

if ($couponStatus == 'Y') {
    echo 'Expired';
} else {
    echo $couponValue;
}

mysqli_close($conn);
 ?>

<?php include('dbConnection.php');

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$otherContactWay = $_POST['otherContactWay'];
$otherContactInfo = $_POST['otherContactInfo'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$zipcode = $_POST['zipcode'];
$notice = $_POST['notice'];
$joinDate = $_POST['joinDate'];
$leaveDate = $_POST['leaveDate'];
$joinLocation = $_POST['joinLocation'];
$leaveLocation = $_POST['leaveLocation'];
$individualTourId = $_POST['individualTourId'];
$exchange_rate = $_POST['exchange_rate'];

$currency = $_POST['currency'];
$payment_type = $_POST['paymentType'];
$payment_amount = $_POST['price'];
$coupon = $_POST['coupon'];


$query = "SELECT * FROM Customer WHERE fname = '$fname' AND lname = '$lname'";
if ($birthday != "") {
    $query .= " AND birth_date = '$birthday'";
}
$result = $conn->query($query);

if ($result->num_rows == 0) {
    $query = "INSERT INTO Customer";
    $columnName = "(fname, lname";
    if ($email != "") {
        $columnName .= ", email";
    }
    if ($phone != "") {
        $columnName .= ", phone";
    }
    if ($otherContactWay != "") {
        $columnName .= ", other_contact_type";
    }
    if ($otherContactInfo != "") {
        $columnName .= ", other_contact_number";
    }
    if ($birthday != "") {
        $columnName .= ", birth_date";
    }
    if ($gender != "") {
        $columnName .= ", gender";
    }
    if ($zipcode != "") {
        $columnName .= ", zipcode";
    }
    if ($notice != "") {
        $columnName .= ", other_information";
    }
    $columnName .= ")";
    $query .= $columnName;
    $query .= " VALUES ('$fname', '$lname'";
    if ($email != "") {
        $query .= ", '$email'";
    }
    if ($phone != "") {
        $query .= ", '$phone'";
    }
    if ($otherContactWay != "") {
        $query .= ", '$otherContactWay'";
    }
    if ($otherContactInfo != "") {
        $query .= ", '$otherContactInfo'";
    }
    if ($birthday != "") {
        $query .= ", '$birthday'";
    }
    if ($gender != "") {
        $query .= ", '$gender'";
    }
    if ($zipcode != "") {
        $query .= ", '$zipcode'";
    }
    if ($notice != "") {
        $query .= ", '$notice'";
    }
    $query .= ")";
    $result = $conn->query($query);
}

// 得到CustomerId
$query = "SELECT customer_id FROM Customer WHERE fname = '$fname' AND lname = '$lname'";
if ($birthday != "") {
    $query .= " AND birth_date = '$birthday'";
}
$query .= " ORDER BY customer_id DESC LIMIT 1";
$result = $conn->query($query);
$customerId = $result->fetch_assoc()['customer_id'];


if (!is_numeric($coupon) and $coupon != "") {
    $couponId = "";
    $couponValue = "";
    $couponStatus = "";

    $query = "SELECT cc_id, discount, code_expired FROM CouponCode WHERE code = '$coupon'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $couponId = $row['cc_id'];
            $couponValue = $row['discount'];
            $couponStatus = $row['code_expired'];
        }
    }

    if ($couponStatus == 'Y') {
        $couponValue = 0;
    }

    $query = "INSERT INTO TourDetails";
    $query .= "(customer_id, indiv_tour_id,";
    if ($joinDate != "") {
        $query .= " join_date,";
    }
    if ($leaveDate != "") {
        $query .= " leave_date,";
    }
    if ($joinLocation != "") {
        $query .= " join_location,";
    }
    if ($leaveLocation != "") {
        $query .= " leave_location,";
    }
    $query .= " currency, payment_type, payment_amount, cc_id, coupon, note, exchange_rate) VAlUES (";
    $query .= "'$customerId', '$individualTourId',";
    if ($joinDate != "") {
        $query .= " '$joinDate',";
    }
    if ($leaveDate != "") {
        $query .= " '$leaveDate',";
    }
    if ($joinLocation != "") {
        $query .= " '$joinLocation',";
    }
    if ($leaveLocation != "") {
        $query .= " '$leaveLocation',";
    }
    $query .= " '$currency', '$payment_type', '$payment_amount', '$couponId', '$couponValue', '$notice', '$exchange_rate')";
    $result = $conn->query($query);

} else if (is_numeric($coupon)){
    $query = "INSERT INTO TourDetails";
    $query .= "(customer_id, indiv_tour_id,";
    if ($joinDate != "") {
        $query .= " join_date,";
    }
    if ($leaveDate != "") {
        $query .= " leave_date,";
    }
    if ($joinLocation != "") {
        $query .= " join_location,";
    }
    if ($leaveLocation != "") {
        $query .= " leave_location,";
    }
    $query .= " currency, payment_type, payment_amount, coupon, note, exchange_rate) VAlUES (";
    $query .= "'$customerId', '$individualTourId',";
    if ($joinDate != "") {
        $query .= " '$joinDate',";
    }
    if ($leaveDate != "") {
        $query .= " '$leaveDate',";
    }
    if ($joinLocation != "") {
        $query .= " '$joinLocation',";
    }
    if ($leaveLocation != "") {
        $query .= " '$leaveLocation',";
    }
    $query .= " '$currency', '$payment_type', '$payment_amount', '$coupon', '$notice', '$exchange_rate')";
    $result = $conn->query($query);
} else {
    $query = "INSERT INTO TourDetails";
    $query .= "(customer_id, indiv_tour_id,";
    if ($joinDate != "") {
        $query .= " join_date,";
    }
    if ($leaveDate != "") {
        $query .= " leave_date,";
    }
    if ($joinLocation != "") {
        $query .= " join_location,";
    }
    if ($leaveLocation != "") {
        $query .= " leave_location,";
    }
    $query .= " currency, payment_type, payment_amount, note, exchange_rate) VAlUES (";
    $query .= "'$customerId', '$individualTourId',";
    if ($joinDate != "") {
        $query .= " '$joinDate',";
    }
    if ($leaveDate != "") {
        $query .= " '$leaveDate',";
    }
    if ($joinLocation != "") {
        $query .= " '$joinLocation',";
    }
    if ($leaveLocation != "") {
        $query .= " '$leaveLocation',";
    }
    $query .= " '$currency', '$payment_type', '$payment_amount', '$notice', '$exchange_rate')";
    $result = $conn->query($query);
}
echo $query;

mysqli_close($conn);
 ?>

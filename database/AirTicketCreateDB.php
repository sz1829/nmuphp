<?php include('dbConnection.php');

$flightCode = $_POST['flightCode'];
$salesperson = $_POST['salesperson'];
$locator = $_POST['locator'];
$roundTrip = $_POST['roundTrip'];
$ticketType = $_POST['ticketType'];
$numOfAdult = $_POST['numOfAdult'];
$numOfChildren = $_POST['numOfChildren'];
$numOfBaby = $_POST['numOfBaby'];
$numPassenger = $_POST['numPassenger'];
$source = $_POST['source'];
$note = $_POST['note'];

$leaveDate = $_POST['leaveDate'];
$arriveDate = $_POST['arriveDate'];
$leaveLocation = $_POST['leaveLocation'];
$arriveLocation = $_POST['arriveLocation'];

$currency = $_POST['currency'];
$payType = $_POST['payType'];
$expense = $_POST['expense'];
$price = $_POST['price'];
$received2 = $_POST['received2'];
$discount = $_POST['discount'];
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$phone = $_POST['phone'];
$otherContact = $_POST['otherContact'];
$otherContactNumber = $_POST['otherContactNumber'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$zipcode = $_POST['zipcode'];
$otherMsg = $_POST['otherMsg'];


// 得到客户id
$customerId = "";
$query = "SELECT customer_id
          From Customer
          WHERE fname = '$firstName'
          AND lname = '$lastName'
          AND birth_date = '$birthday'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    $query = "INSERT INTO Customer";
    $columnName = "(fname, lname, birth_date";
    if ($email != "") $columnName .= ", email";
    if ($phone != "") $columnName .= ", phone";
    if ($otherContact != "") $columnName .= ", other_contact_type";
    if ($otherContactNumber != "") $columnName .= ", other_contact_number";
    if ($gender != "") $columnName .= ", gender";
    if ($zipcode != "") $columnName .= ", zipcode";
    $columnName .= ")";
    $query .= $columnName;
    $query .= " VALUES ('$firstName', '$lastName', '$birthday'";
    if ($email != "") $query .= ", '$email'";
    if ($phone != "") $query .= ", '$phone'";
    if ($otherContact != "") $query .= ", '$otherContact'";
    if ($otherContactNumber != "") $query .= ", '$otherContactNumber'";
    if ($gender != "") $query .= ", '$gender'";
    if ($zipcode != "") $query .= ", '$zipcode'";
    $query .= ")";
    $result = $conn->query($query);

    $query = "SELECT customer_id from Customer WHERE fname = '$firstName' AND lname = '$lastName' AND birth_date = '$birthday'";
    $result = $conn->query($query);
    $customerId = $result->fetch_assoc()['customer_id'];
} else {
    $customerId = $result->fetch_assoc()['customer_id'];
}


// 得到销售id
$salespersonId = "";
$query = "SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'";
$result = $conn->query($query);
$salespersonId = $result->fetch_assoc()['salesperson_id'];


$query = "INSERT INTO AirticketTour(
    flight_code,
    customer_id,
    salesperson_id,
    locators,
    round_trip,
    ticket_type,
    adult_number,
    child_number,
    infant_number,
    depart_date,
    depart_location,
    arrival_date,
    arrival_location)
    VALUES (
        '$flightCode',
        '$customerId',
        '$salespersonId',
        '$locator',
        '$roundTrip',
        '$ticketType',
        '$numOfAdult',
        '$numOfChildren',
        '$numOfBaby',
        '$leaveDate',
        '$leaveLocation',
        '$arriveDate',
        '$arriveLocation'
    )";
$result = $conn->query($query);

$transactionsInsertSql = "";
if (!is_numeric($discount) and $discount != "") {
    $couponId = "";
    $couponValue = "";
    $couponStatus = "";

    $query = "SELECT cc_id, discount, code_expired FROM CouponCode WHERE code = '$discount'";
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

    $transactionsInsertSql = "INSERT INTO Transactions(
        type,
        airticket_tour_id,
        salesperson_id,
        cc_id,
        coupon,
        expense,
        received,
        received2,
        payment_type,
        total_profit,
        create_time,
        source_id,
        currency,
        lock_status,
        clear_status,
        note
    ) VALUES (
        'airticket',
        (SELECT airticket_tour_id FROM AirticketTour WHERE salesperson_id = '$salespersonId' AND customer_id = '$customerId'
            ORDER BY airticket_tour_id DESC LIMIT 1),
        '$salespersonId',
        '$couponId',
        '$couponValue',
        '$expense',
        '$price',
        '$received2',
        '$payType',
        received+received2-expense-'$couponValue',
        current_timestamp,
        (SELECT source_id FROM CustomerSource WHERE source_name = '$source'),
        '$currency',
        'N',
        'N',
        '$note'
    )";
} else if (is_numeric($discount)) {
    $transactionsInsertSql = "INSERT INTO Transactions(
        type,
        airticket_tour_id,
        salesperson_id,
        coupon,
        expense,
        received,
        received2,
        payment_type,
        total_profit,
        create_time,
        source_id,
        currency,
        lock_status,
        clear_status,
        note
    ) VALUES (
        'airticket',
        (SELECT airticket_tour_id FROM AirticketTour WHERE salesperson_id = '$salespersonId' AND customer_id = '$customerId'
            ORDER BY airticket_tour_id DESC LIMIT 1),
        '$salespersonId',
        '$discount',
        '$expense',
        '$price',
        '$received2',
        '$payType',
        received+received2-expense-'$discount',
        current_timestamp,
        (SELECT source_id FROM CustomerSource WHERE source_name = '$source'),
        '$currency',
        'N',
        'N',
        '$note'
    )";
} else {
    $transactionsInsertSql = "INSERT INTO Transactions(
        type,
        airticket_tour_id,
        salesperson_id,
        expense,
        received,
        received2,
        payment_type,
        total_profit,
        create_time,
        source_id,
        currency,
        lock_status,
        clear_status,
        note
    ) VALUES (
        'airticket',
        (SELECT airticket_tour_id FROM AirticketTour WHERE salesperson_id = '$salespersonId' AND customer_id = '$customerId'
            ORDER BY airticket_tour_id DESC LIMIT 1),
        '$salespersonId',
        '$expense',
        '$price',
        '$received2',
        '$payType',
        received+received2-expense-'$discount',
        current_timestamp,
        (SELECT source_id FROM CustomerSource WHERE source_name = '$source'),
        '$currency',
        'N',
        'N',
        '$note'
    )";
}
$transactionsInsertResult = $conn->query($transactionsInsertSql);

mysqli_close($conn);
 ?>

<?php include('dbConnection.php');

// POST data from front-end
$groupTourId = $_POST['groupNum'];
$flightNum = $_POST['flightNum'];
$busCompany = $_POST['busCompany'];
$salesperson_code = $_POST['salespersonInput'];

$tourGuideName = $_POST['tourGuide'];
$tourGuideName = explode(" ", $tourGuideName)[0];

$tourGuidePhone = $_POST['guideTel'];
$agency = $_POST['agency'];
$groupTourSource = $_POST['groupTourSource'];
$leaderNumber = $_POST['leaderNumber'];
$visitorNumber = $_POST['visitorNumber'];
$note = $_POST['note'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$duration = $_POST['duration'];
$currency = $_POST['currency'];
$paymentType = $_POST['paymentType'];
$price = $_POST['price'];
$reserve = $_POST['reserve'];
$write_off = $_POST['write_off'];
$total_cost = $_POST['total_cost'];
$coupon = $_POST['coupon'];

// Group Tour
$groupTourInsertSql = "INSERT INTO GroupTour(
    group_code,
    flight_number,
    bus_company,
    salesperson_id,
    guide_id,
    agency_name,
    leader_number,
    tourist_number,
    start_date,
    end_date,
    duration,
    price,
    reserve,
    write_off,
    total_cost)
    VALUES(
        '$groupTourId',
        '$flightNum',
        '$busCompany',
        (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson_code'),
        (SELECT guide_id FROM TouristGuide WHERE fname = '$tourGuideName' AND phone = '$tourGuidePhone'),
        '$agency',
        '$leaderNumber',
        '$visitorNumber',
        '$startTime',
        '$endTime',
        '$duration',
        '$price',
        '$reserve',
        '$write_off',
        '$total_cost'
    )";
// echo $groupTourInsertSql;
$groupTourInsertResult = $conn->query($groupTourInsertSql);


$salespersonId = "";
$query = "SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson_code'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $salespersonId = $row['salesperson_id'];
    }
}

$transactionsInsertSql = "";
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

    $transactionsInsertSql = "INSERT INTO Transactions(
            type,
            lock_status,
            clear_status,
            group_tour_id,
            salesperson_id,
            cc_id,
            coupon,
            expense,
            received,
            payment_type,
            total_profit,
            note,
            create_time,
            source_id,
            currency)
        VALUES(
            'group',
            'N',
            'N',
            (SELECT group_tour_id FROM GroupTour WHERE group_code = '$groupTourId' AND
            salesperson_id = '$salespersonId' ORDER BY group_tour_id DESC LIMIT 1),
            '$salespersonId',
            '$couponId',
            '$couponValue',
            '$total_cost',
            '$price',
            '$paymentType',
            received2+received-expense-'$couponValue',
            '$note',
            current_timestamp,
            (SELECT source_id FROM CustomerSource WHERE source_name = '$groupTourSource'),
            '$currency'
        )";
} else if (is_numeric($coupon)){
    $transactionsInsertSql = "INSERT INTO Transactions(
            type,
            lock_status,
            clear_status,
            group_tour_id,
            salesperson_id,
            coupon,
            expense,
            received,
            payment_type,
            total_profit,
            note,
            create_time,
            source_id,
            currency)
        VALUES(
            'group',
            'N',
            'N',
            (SELECT group_tour_id FROM GroupTour WHERE group_code = '$groupTourId' AND
            salesperson_id = '$salespersonId' ORDER BY group_tour_id DESC LIMIT 1),
            '$salespersonId',
            '$coupon',
            '$total_cost',
            '$price',
            '$paymentType',
            received2+received-expense-'$coupon',
            '$note',
            current_timestamp,
            (SELECT source_id FROM CustomerSource WHERE source_name = '$groupTourSource'),
            '$currency'
        )";
} else {
    $transactionsInsertSql = "INSERT INTO Transactions(
            type,
            lock_status,
            clear_status,
            group_tour_id,
            salesperson_id,
            expense,
            received,
            payment_type,
            total_profit,
            note,
            create_time,
            source_id,
            currency)
        VALUES(
            'group',
            'N',
            'N',
            (SELECT group_tour_id FROM GroupTour WHERE group_code = '$groupTourId' AND
            salesperson_id = '$salespersonId' ORDER BY group_tour_id DESC LIMIT 1),
            '$salespersonId',
            '$total_cost',
            '$price',
            '$paymentType',
            received2+received-expense-'$coupon',
            '$note',
            current_timestamp,
            (SELECT source_id FROM CustomerSource WHERE source_name = '$groupTourSource'),
            '$currency'
        )";
}

$transactionsInsertResult = $conn->query($transactionsInsertSql);

mysqli_close($conn);

?>

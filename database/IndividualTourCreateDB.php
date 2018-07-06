<?php include('dbConnection.php');

$indiv_tour_id = $_POST['indiv_tour_id'];
$indiv_tour_name = $_POST['indiv_tour_name'];
$indiv_salesperson = $_POST['indiv_salesperson'];
$indiv_wholesaler = $_POST['indiv_wholesaler'];
$indiv_touristCount = $_POST['indiv_touristCount'];
$indiv_source = $_POST['indiv_source'];
$indiv_note = $_POST['indiv_note'];
$indiv_startTime = $_POST['indiv_startTime'];
$indiv_endTime = $_POST['indiv_endTime'];
$indiv_num_days = $_POST['indiv_num_days'];
$indiv_total_cost = $_POST['indiv_total_cost'];
$indiv_exchange_rate = $_POST['indiv_exchange_rate'];

$currency = json_decode($_POST['currency']);
$indiv_payment_amount = json_decode($_POST['payment_amount']);
$coupon = json_decode($_POST['coupon']);

$total_payment_amount = 0;
$total_coupon = 0;

for ($i = 0; $i < sizeof($indiv_payment_amount); $i++) {
    if (!is_numeric($coupon[$i]) and $coupon[$i] != "") {
        $couponId = "";
        $couponValue = "";
        $couponStatus = "";

        $query = "SELECT cc_id, discount, code_expired FROM CouponCode WHERE code = '$coupon[$i]'";
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

        if ($currency[$i] == 'RMB') {
            $total_payment_amount += floatval($indiv_payment_amount[$i]) / floatval($indiv_exchange_rate);
            $total_coupon += floatval($couponValue) / floatval($indiv_exchange_rate);
        } else {
            $total_payment_amount += floatval($indiv_payment_amount[$i]);
            $total_coupon += floatval($couponValue);
        }
    } else if (is_numeric($coupon[$i])) {
        if ($currency[$i] == 'RMB') {
            $total_payment_amount += floatval($indiv_payment_amount[$i]) / floatval($indiv_exchange_rate);
            $total_coupon += floatval($coupon[$i]) / floatval($indiv_exchange_rate);
        } else {
            $total_payment_amount += floatval($indiv_payment_amount[$i]);
            $total_coupon += floatval($coupon[$i]);
        }
    }
}


// 得到零售商id
$query = "SELECT wholesaler_id FROM Wholesaler WHERE wholesaler_code = '$indiv_wholesaler'";
$result = $conn->query($query);
$wholesaler_id = $result->fetch_assoc()['wholesaler_id'];

// 得到销售id
$query = "SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$indiv_salesperson'";
$result = $conn->query($query);
$salesperson_id = $result->fetch_assoc()['salesperson_id'];

// 插入IndividualTour
$query = "INSERT INTO IndividualTour(
    product_code,
    tour_name,
    wholesaler_id,
    salesperson_id,
    indiv_number,
    depart_date,
    arrival_date)
    VALUES (
        '$indiv_tour_id',
        '$indiv_tour_name',
        '$wholesaler_id',
        '$salesperson_id',
        '$indiv_touristCount',
        '$indiv_startTime',
        '$indiv_endTime'
    )";
$result = $conn->query($query);

// 得到IndividualTour Id
$query = "SELECT indiv_tour_id from IndividualTour WHERE salesperson_id = '$salesperson_id' ORDER BY indiv_tour_id DESC LIMIT 1";
$result = $conn->query($query);
$individualTourId = $result->fetch_assoc()['indiv_tour_id'];

$transactionsInsertSql = "INSERT INTO Transactions(
        type,
        lock_status,
        clear_status,
        indiv_tour_id,
        salesperson_id,
        expense,
        received,
        coupon,
        payment_type,
        total_profit,
        note,
        create_time,
        source_id,
        currency)
    VALUES(
        'individual',
        'N',
        'N',
        '$individualTourId',
        '$salesperson_id',
        '$indiv_total_cost',
        '$total_payment_amount',
        $total_coupon,
        'multiple',
        received2+received-expense-'$total_coupon',
        '$indiv_note',
        current_timestamp,
        (SELECT source_id FROM CustomerSource WHERE source_name = '$indiv_source'),
        'USD'
    )";
$conn->query($transactionsInsertSql);

echo $individualTourId;

mysqli_close($conn);

?>

<?php include('../../dbConnection.php');

$offset = empty($_GET['offset']) ? 0 : $_GET['offset'];
$transaction_id = empty($_GET['transaction_id']) ? '%' : $_GET['transaction_id'];
$from_date = empty($_GET['from_date']) ? '%' : $_GET['from_date'];
$to_date = empty($_GET['to_date']) ? date('Y-m-d', strtotime(' +1 day')) : $_GET['to_date'];
$locator = empty($_GET['locator']) ? '%' : $_GET['locator'];
$salesperson_code = empty($_GET['salesperson_code']) ? '%' : $_GET['salesperson_code'];

$query = "SELECT transaction_id, create_time, flight_code, locators, depart, arrival,
                 payment_type, currency, total_profit, received, received2, expense, coupon
          FROM AirticketTourOrder
          WHERE transaction_id LIKE '$transaction_id'
            AND create_time >= '$from_date'
            AND create_time < '$to_date'
            AND locators LIKE '$locator'
            AND salesperson_code LIKE '$salesperson_code'
            AND clear_status = 'N'
            AND lock_status = 'N'
          LIMIT 15 OFFSET $offset";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li><dl class='callout_button'>
                <dd class='listNum'><a href='javascript:void(0);'>" . $row['transaction_id'] . "</a></dd>
                <dd class='listCreatTime'><a href='javascript:void(0);'>" . $row['create_time'] . "</a></dd>
                <dd class='listFightNum'><a href='javascript:void(0);'>" . $row['flight_code'] . "</a></dd>
                <dd class='listLocation'><a href='javascript:void(0);'>" . $row['locators'] . "</a></dd>
                <dd class='listPayment'><a href='javascript:void(0);'>" . $row['payment_type'] . "</a></dd>
                <dd class='listCurrency'><a href='javascript:void(0);'>" . $row['currency'] . "</a></dd>
                <dd class='listProfit'><a href='javascript:void(0);'>" . $row['total_profit'] . "</a></dd>
                <dd class='listPrice'><a href='javascript:void(0);'>" . $row['received'] . "</a></dd>
                <dd class='listReturnCash'><a href='javascript:void(0);'>" . $row['received2'] . "</a></dd>
                <dd class='listCost'><a href='javascript:void(0);'>" . $row['expense'] . "</a></dd>
                <dd class='listDiscount'><a href='javascript:void(0);'>" . $row['coupon'] . "</a></dd>
            </dl></li>";
    }
}

mysqli_close($conn);
?>

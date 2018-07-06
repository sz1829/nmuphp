<?php include('../../dbConnection.php');

session_start();
$login_username = $_SESSION["username"];
$group_name = $_SESSION["group_name"];

if ($group_name != 'normal') {
    $login_username = '%';
}

$offset = empty($_GET['offset']) ? 0 : $_GET['offset'];
$transaction_id = empty($_GET['transaction_id']) ? '%' : $_GET['transaction_id'];
$from_date = empty($_GET['from_date']) ? '%' : $_GET['from_date'];
$to_date = empty($_GET['to_date']) ? date('Y-m-d', strtotime(' +1 day')) : $_GET['to_date'];
$product_code = empty($_GET['product_code']) ? '%' : $_GET['product_code'];
$salesperson_code = $login_username;

$query = "SELECT transaction_id, create_time, product_code, tour_name,
                wholesaler_code, schedule, payment_type, currency, total_profit,
                revenue, cost, coupon
          FROM IndividualTourOrder
          WHERE transaction_id LIKE '$transaction_id'
            AND create_time >= '$from_date'
            AND create_time < '$to_date'
            AND product_code LIKE '$product_code'
            AND clear_status = 'N'
            AND lock_status = 'N'
            AND salesperson_code LIKE '$salesperson_code'
          LIMIT 15 OFFSET $offset";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li>
            <dl class='callout_button'>
            <dd class='listNum'><a href='javascript:void(0);'>" . $row['transaction_id'] . "</a></dd>
            <dd class='listCreatTime'><a href='javascript:void(0);'>" . $row['create_time'] . "</a></dd>
            <dd class='listGroupNum'><a href='javascript:void(0);'>" . $row['product_code'] . "</a></dd>
            <dd class='listSales'><a href='javascript:void(0);'>" . $row['wholesaler_code'] . "</a></dd>
            <dd class='listJourney'><a href='javascript:void(0);'>" . $row['schedule'] . "</a></dd>
            <dd class='listPayment'><a href='javascript:void(0);'>" . $row['payment_type'] . "</a></dd>
            <dd class='listCurrency'><a href='javascript:void(0);'>" . $row['currency'] . "</a></dd>
            <dd class='listProfit'><a href='javascript:void(0);'>" . $row['total_profit'] . "</a></dd>
            <dd class='listPrice'><a href='javascript:void(0);'>" . $row['revenue'] . "</a></dd>
            <dd class='listCost'><a href='javascript:void(0);'>" . $row['cost'] . "</a></dd>
            <dd class='listDiscount'><a href='javascript:void(0);'>" . $row['coupon'] . "</a></dd>
            </dl>
        </li>";
    }
}


mysqli_close($conn);
?>

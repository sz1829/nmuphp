<?php include('dbConnection.php');

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
$group_code = empty($_GET['group_code']) ? '%' : $_GET['group_code'];

$query = "SELECT * FROM GroupTourOrder WHERE transaction_id in
            (SELECT id_table.transaction_id FROM
                (SELECT t.transaction_id,
                        g.group_code,
                        t.create_time
                FROM Transactions t JOIN GroupTour g ON t.group_tour_id = g.group_tour_id) id_table
            WHERE
            transaction_id LIKE '$transaction_id'
            AND create_time >= '$from_date'
            AND create_time < '$to_date'
            AND group_code LIKE '$group_code'
            AND clear_status = 'N' AND lock_status = 'N'
            AND salesperson_code LIKE '$login_username') LIMIT 15 OFFSET $offset";

$result = $conn->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li>
            <dl class='callout_button'>
            <dd class='listNum'><a href='javascript:void(0);'>" . $row['transaction_id'] . "</a></dd>
            <dd class='listCreatTime'><a href='javascript:void(0);'>" . $row['create_time'] . "</a></dd>
            <dd class='listGroupNum'><a href='javascript:void(0);'>" . $row['group_code'] . "</a></dd>
            <dd class='listJourney'><a href='javascript:void(0);'>" . $row['schedule'] . "</a></dd>
            <dd class='listPayment'><a href='javascript:void(0);'>" . $row['payment_type'] . "</a></dd>
            <dd class='listCurrency'><a href='javascript:void(0);'>" . $row['currency'] . "</a></dd>
            <dd class='listProfit'><a href='javascript:void(0);'>" . $row['profit'] . "</a></dd>
            <dd class='listPrice'><a href='javascript:void(0);'>" . $row['price'] . "</a></dd>
            <dd class='listCost'><a href='javascript:void(0);'>" . $row['cost'] . "</a></dd>
            <dd class='listDiscount'><a href='javascript:void(0);'>" . $row['coupon'] . "</a></dd>
            </dl>
        </li>";
    }
}

mysqli_close($conn);

?>

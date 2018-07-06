<?php include('dbConnection.php');

session_start();
$login_username = $_SESSION["username"];
$group_name = $_SESSION["group_name"];

if ($group_name != 'normal') {
    $login_username = '%';
}

/*
* Get the number of orders to be displayed
*/
if ($_GET['orderType'] == 'group') {
    $transaction_id = empty($_GET['transaction_id']) ? '%' : $_GET['transaction_id'];
    $from_date = empty($_GET['from_date']) ? '%' : $_GET['from_date'];
    $to_date = empty($_GET['to_date']) ? date('Y-m-d', strtotime(' +1 day')) : $_GET['to_date'];
    $group_code = empty($_GET['group_code']) ? '%' : $_GET['group_code'];
    $salesperson_code = $login_username;

    $query = "SELECT COUNT(*) FROM GroupTourOrder
              WHERE transaction_id LIKE '$transaction_id'
              AND create_time >= '$from_date'
              AND create_time < '$to_date'
              AND group_code LIKE '$group_code'
              AND clear_status = 'N'
              AND lock_status = 'N'
              AND salesperson_code LIKE '$salesperson_code'";
    $result = $conn->query($query);
    echo $result->fetch_assoc()['COUNT(*)'];
} else if ($_GET['orderType'] == 'individual') {
    $transaction_id = empty($_GET['transaction_id']) ? '%' : $_GET['transaction_id'];
    $from_date = empty($_GET['from_date']) ? '%' : $_GET['from_date'];
    $to_date = empty($_GET['to_date']) ? date('Y-m-d', strtotime(' +1 day')) : $_GET['to_date'];
    $product_code = empty($_GET['product_code']) ? '%' : $_GET['product_code'];
    $salesperson_code = $login_username;

    $query = "SELECT COUNT(*) FROM IndividualTourOrder
              WHERE transaction_id LIKE '$transaction_id'
                AND create_time >= '$from_date'
                AND create_time < '$to_date'
                AND product_code LIKE '$product_code'
                AND clear_status = 'N'
                AND lock_status = 'N'
                AND salesperson_code LIKE '$salesperson_code'";
    $result = $conn->query($query);
    echo $result->fetch_assoc()['COUNT(*)'];
} else if ($_GET['orderType'] == 'airticket') {
    $transaction_id = empty($_GET['transaction_id']) ? '%' : $_GET['transaction_id'];
    $from_date = empty($_GET['from_date']) ? '%' : $_GET['from_date'];
    $to_date = empty($_GET['to_date']) ? date('Y-m-d', strtotime(' +1 day')) : $_GET['to_date'];
    $salesperson_code = $login_username;
    $locator = empty($_GET['locator']) ? '%' : $_GET['locator'];

    $query = "SELECT COUNT(*) FROM AirticketTourOrder
              WHERE transaction_id LIKE '$transaction_id'
              AND create_time >= '$from_date'
              AND create_time < '$to_date'
              AND locators LIKE '$locator'
              AND salesperson_code LIKE '$salesperson_code'
              AND clear_status = 'N'
              AND lock_status = 'N'";
    $result = $conn->query($query);
    echo $result->fetch_assoc()['COUNT(*)'];
}

mysqli_close($conn);
 ?>

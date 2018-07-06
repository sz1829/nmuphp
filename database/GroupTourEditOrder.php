<?php
include('dbConnection.php');

class GroupTourEdit {
    function getOrderDetail($transactionId) {
        global $conn;
        $query = "SELECT * FROM
                    (SELECT t.transaction_id,
                        /*section 1*/
                        gto.group_code, gto.flight_number, gto.bus_company, gto.salesperson_code,
                        gto.guide_name, gto.guide_phone, gto.agency_name, gto.source_name , g.leader_number, g.tourist_number, gto.note,
                        /*section 2*/
                        g.start_date, g.end_date, g.duration,
                        /*section 3*/
                        gto.currency, gto.payment_type, gto.price, g.reserve, g.write_off, g.total_cost, t.cc_id, gto.coupon, (SELECT code FROM CouponCode where cc_id = t.cc_id) as cc_code
                    FROM GroupTourOrder gto
                    JOIN Transactions t ON gto.transaction_id = t.transaction_id
                    JOIN GroupTour g ON t.group_tour_id = g.group_tour_id) default_display
                    WHERE transaction_id = '$transactionId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            return json_encode($result->fetch_assoc());
        }
    }

    function updateOrder() {
        $transactionId = $_POST['transactionId'];
        global $conn;

        // Get group code
        $query = "SELECT group_tour_id FROM Transactions WHERE transaction_id = '$transactionId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $group_tour_id = $result->fetch_assoc()['group_tour_id'];
        } else {
            return "Group tour order not exist";
        }


        $group_code = $_POST['group_code'];
        $flight_number = $_POST['flight_number'];
        $bus_company = $_POST['bus_company'];
        $salesperson = $_POST['salesperson'];
        $tourist_guide = $_POST['tourist_guide'];
        $fname = explode(" ", $tourist_guide)[0];
        // $lname = explode(" ", $tourist_guide)[1];
        $guide_phone = $_POST['guide_phone'];
        $agency = $_POST['agency'];
        $source = $_POST['source'];
        $leader_number = $_POST['leader_number'];
        $visitor_number = $_POST['visitor_number'];
        $note = $_POST['note'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $duration = $_POST['duration'];
        $currency = $_POST['currency'];
        $payment_type = $_POST['payment_type'];
        $price = $_POST['price'];
        $reserve = $_POST['reserve'];
        $write_off = $_POST['write_off'];
        $total_cost = $_POST['total_cost'];
        $coupon = $_POST['coupon'];

        // Update GroupTour table
        $query = "UPDATE GroupTour
                  SET group_code = '$group_code', flight_number = '$flight_number', bus_company = '$bus_company',
                    salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                    guide_id = (SELECT guide_id FROM TouristGuide WHERE fname = '$fname' AND phone = '$guide_phone'),
                    agency_name = '$agency', leader_number = $leader_number, tourist_number = $visitor_number,
                    start_date = '$start_date', end_date = '$end_date', duration = $duration,
                    price = $price, reserve = $reserve, write_off = $write_off, total_cost = $total_cost,
                    other_expense = total_cost - reserve - write_off
                  WHERE group_tour_id = '$group_tour_id'";
        $result = $conn->query($query);

        // Update Transactions table
        if (empty($coupon)) {
            $query = "UPDATE Transactions
                      SET salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                        expense = $total_cost, received = $price,
                        source_id = (SELECT source_id FROM CustomerSource WHERE source_name = '$source'),
                        currency = '$currency', note = '$note', total_profit = received - expense, payment_type = '$payment_type'
                        WHERE group_tour_id = '$group_tour_id'";
            echo $query;
            $result = $conn->query($query);
        } else {
            if (!is_numeric($coupon)) {
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
                    $couponId = NULL;
                }
            } else if (is_numeric($coupon)) {
                $couponId = NULL;
                $couponValue = $coupon;
            }
            $query = "UPDATE Transactions
                      SET salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                        expense = $total_cost, received = $price,
                        source_id = (SELECT source_id FROM CustomerSource WHERE source_name = '$source'), payment_type = '$payment_type',
                        currency = '$currency', note = '$note'";
            if ($couponId == NULL) {
                $query .= ", cc_id = NULL";
            } else {
                $query .= ", cc_id = '$couponId'";
            }
            $query .= ", coupon = $couponValue, total_profit = received - expense - coupon WHERE group_tour_id = '$group_tour_id'";
            echo $query;
            $result = $conn->query($query);
        }
    }

    function deleteOrder() {
        $transactionId = $_GET['transaction_id'];
        global $conn;

        $query = "SELECT group_tour_id FROM Transactions WHERE transaction_id = '$transactionId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $groupTourId = $result->fetch_assoc()['group_tour_id'];
        }

        $query = "DELETE FROM Transactions WHERE transaction_id = '$transactionId'";
        $conn->query($query);
        $query = "DELETE FROM GroupTour WHERE group_tour_id  = '$groupTourId'";
        $conn->query($query);
    }
}


$GroupTourEdit = new GroupTourEdit();
if ($_GET['action'] == 'getDetail') {
    $result = $GroupTourEdit->getOrderDetail($_GET['transaction_id']);
} else if ($_POST['action'] == 'updateOrder') {
    $result = $GroupTourEdit->updateOrder();
} else if ($_GET['action'] == 'deleteOrder') {
    $result = $GroupTourEdit->deleteOrder();
}
echo $result;

mysqli_close($conn);
?>

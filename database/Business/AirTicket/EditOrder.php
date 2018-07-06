<?php
include('../../dbConnection.php');

class AirTicket {
    function getAirTicketTourId($transactionId) {
        global $conn;

        $query = "SELECT airticket_tour_id FROM Transactions WHERE transaction_id = $transactionId";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $airticket_tour_id = $result->fetch_assoc()['airticket_tour_id'];
        } else {
            return "Air ticket order not exist";
        }
        return $airticket_tour_id;
    }

    function getOrderDetail($transactionId) {
        global $conn;
        $query = "SELECT
                    ato.flight_code, ato.salesperson_code, ato.locators, ato.round_trip, ato.ticket_type,
                    att.adult_number, att.child_number, att.infant_number, ato.source_name, ato.note,
                    att.depart_date, att.depart_location, att.arrival_date, att.arrival_location,
                    ato.currency, ato.payment_type, ato.expense, ato.received, ato.received2, t.cc_id, t.coupon,
                    (SELECT code FROM CouponCode where cc_id = t.cc_id) as cc_code
                  FROM AirTicketTourOrder ato
                  JOIN Transactions t
                  ON ato.transaction_id = t.transaction_id
                  JOIN AirTicketTour att
                  ON t.airticket_tour_id = att.airticket_tour_id
                  WHERE ato.transaction_id = $transactionId";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            return json_encode($result->fetch_assoc());
        }
    }

    function getCustomerList($transactionId) {
        global $conn;
        $airticket_tour_id = $this->getAirTicketTourId($transactionId);
        $query = "SELECT
                    fname, lname, phone, other_contact_type, other_contact_number,
                    birth_date, gender, email, zipcode
                  FROM Customer
                  WHERE customer_id = (SELECT customer_id FROM AirTicketTour WHERE airticket_tour_id = $airticket_tour_id)";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            return json_encode($result->fetch_assoc());
        }
    }

    function updateOrder() {
        $transactionId = $_POST['transactionId'];
        global $conn;

        $airticket_tour_id = $this->getAirTicketTourId($transactionId);

        $flight_code = $_POST['flight_code'];
        $salesperson = $_POST['salesperson'];
        $locator = $_POST['locator'];
        $round_trip = $_POST['round_trip'];
        $ticket_type = $_POST['ticket_type'];
        $adult_number = $_POST['adult_number'];
        $children_number = $_POST['children_number'];
        $infant_number = $_POST['infant_number'];
        $total_number = $_POST['total_number'];
        $source = $_POST['source'];
        $note = (empty($_POST['note']))? NULL : $_POST['note'];

        $leave_date = $_POST['leave_date'];
        $leave_location = $_POST['leave_location'];
        $arrive_date = $_POST['arrive_date'];
        $arrive_location = $_POST['arrive_location'];

        $currency = $_POST['currency'];
        $payment_type = $_POST['payment_type'];
        $cost = $_POST['cost'];
        $receive1 = $_POST['receive1'];
        $receive2 = $_POST['receive2'];
        $coupon = $_POST['coupon'];

        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $phone = $_POST['phone'];
        $other_contact_type = $_POST['other_contact_type'];
        $other_contact_number = (empty($_POST['other_contact_number']))? NULL : $_POST['other_contact_number'];

        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $email = (empty($_POST['email']))? NULL : $_POST['email'];
        $zipcode = (empty($_POST['zipcode']))? NULL : $_POST['zipcode'];


        $query = "SELECT customer_id FROM Customer WHERE fname = '$fname' AND lname = '$lname' AND birth_date = '$birthday' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $customer_id = $result->fetch_assoc()['customer_id'];
            # 更新已有的客户信息
            $query = "UPDATE Customer
                      SET fname = '$fname', lname = '$lname', phone = '$phone',
                          other_contact_type = '$other_contact_type', other_contact_number = '$other_contact_number',
                          birth_date = '$birthday', gender = '$gender', email = '$email', zipcode = '$zipcode'
                      where customer_id = $customer_id";
            $conn->query($query);
        } else {
            # 添加新的客户信息
            $query = "INSERT INTO Customer
                        (fname, lname, email, phone, other_contact_type, other_contact_number, birth_date, gender, zipcode)
                      VALUES
                        ('$fname', '$lname', '$email', '$phone', '$other_contact_type', '$other_contact_number', '$birthday', '$gender', '$zipcode')";
            $conn->query($query);
            $query = "SELECT customer_id FROM Customer WHERE fname = '$fname' AND lname = '$lname' AND birth_date = '$birthday' LIMIT 1";
            $result = $conn->query($query);
            $customer_id = $result->fetch_assoc()['customer_id'];
        }

        // Update AirTicket table
        $query = "UPDATE
                    AirTicketTour
                  SET
                    flight_code = '$flight_code',
                    salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                    locators = '$locator', round_trip = '$round_trip', ticket_type = '$ticket_type',
                    adult_number = $adult_number, child_number = $children_number, infant_number = $infant_number,
                    depart_date = '$leave_date', depart_location = '$leave_location',
                    arrival_date = '$arrive_date', arrival_location = '$arrive_location',
                    customer_id = $customer_id
                  WHERE
                    airticket_tour_id = $airticket_tour_id";
        $conn->query($query);

        // Update Transactions table
        if (empty($coupon)) {
            # if no coupon is used
            $query = "UPDATE
                        Transactions
                      SET
                        salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                        currency = '$currency',
                        payment_type = '$payment_type',
                        source_id = (SELECT source_id FROM CustomerSource WHERE source_name = '$source'),
                        note = '$note',
                        expense = $cost,
                        received = $receive1,
                        received2 = $receive2,
                        total_profit = received+received2-expense
                      WHERE
                        transaction_id = $transactionId";
            $result = $conn->query($query);
        } else {
            if (!is_numeric($coupon)) {
                # if coupon code is used
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
                # if coupon value is used
                $couponId = NULL;
                $couponValue = $coupon;
            }
            $query = "UPDATE
                        Transactions
                      SET
                        salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                        currency = '$currency',
                        payment_type = '$payment_type',
                        source_id = (SELECT source_id FROM CustomerSource WHERE source_name = '$source'),
                        note = '$note',
                        expense = $cost,
                        received = $receive1,
                        received2 = $receive2";
            if ($couponId == NULL) {
                # if using coupon value or coupon is expired
                $query .= ", cc_id = NULL";
            } else {
                # if using a valid coupon code
                $query .= ", cc_id = '$couponId'";
            }
            $query .= ", coupon = $couponValue, total_profit = received+received2-expense-coupon WHERE transaction_id = $transactionId";
            $conn->query($query);
        }
    }

    function deleteOrder() {
        global $conn;
        $transactionId = $_POST['transaction_id'];
        $airticket_tour_id = $this->getAirTicketTourId($transactionId);

        $query = "DELETE FROM Transactions WHERE transaction_id = $transactionId";
        $conn->query($query);
        $query = "DELETE FROM AirticketTour WHERE airticket_tour_id = $airticket_tour_id";
        $conn->query($query);
    }
}


$airticket = new AirTicket();
if ($_GET['action'] == 'getDetail') {
    $result = $airticket->getOrderDetail($_GET['transaction_id']);
} else if ($_POST['action'] == 'updateOrder') {
    $airticket->updateOrder();
    $result = "Update successfully";
}
else if ($_POST['action'] == 'deleteOrder') {
    $airticket->deleteOrder();
    $result = "Delete successfully";
} else if ($_GET['action'] == 'getCustomerList') {
    $result = $airticket->getCustomerList($_GET['transaction_id']);
}
echo $result;

mysqli_close($conn);
?>

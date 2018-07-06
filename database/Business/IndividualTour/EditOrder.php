<?php
include('../../dbConnection.php');

class IndividualTourEdit {
    function getIndividualTourId($transactionId) {
        global $conn;

        $query = "SELECT
                    indiv_tour_id
                  FROM
                    Transactions
                  WHERE
                    transaction_id = '$transactionId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $indiv_tour_id = $result->fetch_assoc()['indiv_tour_id'];
        } else {
            return "Individual tour order not exist";
        }
        return $indiv_tour_id;
    }

    function getOrderDetail($transactionId) {
        global $conn;

        $query = "SELECT
                    t.transaction_id, t.indiv_tour_id, it.product_code, it.tour_name, s.salesperson_code,
                    w.wholesaler_code,it.indiv_number, sn.source_name, t.note,
                    it.depart_date, it.arrival_date, DATEDIFF(it.arrival_date, it.depart_date)+1 AS 'duration',
                    t.currency, t.payment_type, t.expense, t.received, t.cc_id, t.coupon,
                    (SELECT code FROM CouponCode where cc_id = t.cc_id) as cc_code
                  FROM
                    Transactions t
                  RIGHT JOIN
                    IndividualTour it
                  ON
                    t.indiv_tour_id =  it.indiv_tour_id
                  JOIN
                    Salesperson s
                  ON
                    t.salesperson_id = s.salesperson_id
                  JOIN
                    Wholesaler w
                  ON
                    it.wholesaler_id = w.wholesaler_id
                  JOIN
                    CustomerSource sn
                  ON
                    t.source_id = sn.source_id
                  WHERE
                    transaction_id = '$transactionId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            return json_encode($result->fetch_assoc());
        }
    }

    function getCustomerList($transactionId) {
        global $conn;
        $indiv_tour_id = $this->getIndividualTourId($transactionId);
        $query = "SELECT *
                  FROM
                    (SELECT
                        c.customer_id, cl.indiv_tour_id, c.fname, c.lname, c.gender,
                        c.birth_date, c.email, c.phone, c.zipcode,
                        c.other_contact_type, c.other_contact_number,
                        cl.join_date, cl.join_location, cl.leave_date,
                        cl.leave_location, cl.note
                     FROM
                        TourDetails cl
                     JOIN
                        Customer c
                     ON
                        cl.customer_id = c.customer_id) client_board
                  WHERE
                    indiv_tour_id  = '$indiv_tour_id'";
        $result = $conn->query($query);
        $res = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res[] = $row;
            }
        }
        return json_encode($res);
    }

    function updateOrder() {
        $transactionId = $_POST['transactionId'];
        global $conn;

        $indiv_tour_id = $this->getIndividualTourId($transactionId);

        $product_code = $_POST['product_code'];
        $tour_name = $_POST['tour_name'];
        $salesperson = $_POST['salesperson'];
        $wholesaler = $_POST['wholesaler'];
        $indiv_number = $_POST['indiv_number'];
        $source = $_POST['source'];
        $note = $_POST['note'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $duration = $_POST['duration'];
        $currency = $_POST['currency'];
        $payment_type = $_POST['payment_type'];
        $total_cost = $_POST['total_cost'];
        $receive = $_POST['receive'];
        $coupon = $_POST['coupon'];


        // Update IndividualTour table
        $query = "UPDATE
                    IndividualTour
                  SET
                    product_code = '$product_code',
                    tour_name = '$tour_name',
                    salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                    wholesaler_id = (SELECT wholesaler_id FROM Wholesaler WHERE wholesaler_code = '$wholesaler'),
                    indiv_number = $indiv_number,
                    depart_date = '$start_date',
                    arrival_date = '$end_date'
                  WHERE
                    indiv_tour_id = $indiv_tour_id";
        $result = $conn->query($query);

        // Update Transactions table
        if (empty($coupon)) {
            $query = "UPDATE
                        Transactions
                      SET
                        salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                        currency = '$currency',
                        payment_type = '$payment_type',
                        source_id = (SELECT source_id FROM CustomerSource WHERE source_name = '$source'),
                        note = '$note',
                        expense = $total_cost,
                        received = $receive,
                        total_profit = received-expense
                      WHERE
                        transaction_id = $transactionId";
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
            $query = "UPDATE
                        Transactions
                      SET
                        salesperson_id = (SELECT salesperson_id FROM Salesperson WHERE salesperson_code = '$salesperson'),
                        currency = '$currency',
                        payment_type = '$payment_type',
                        source_id = (SELECT source_id FROM CustomerSource WHERE source_name = '$source'),
                        note = '$note',
                        expense = $total_cost,
                        received = $receive";
            if ($couponId == NULL) {
                $query .= ", cc_id = NULL";
            } else {
                $query .= ", cc_id = '$couponId'";
            }
            $query .= ", coupon = $couponValue, total_profit = received - expense - coupon WHERE transaction_id = $transactionId";
            $result = $conn->query($query);
        }
    }

    function deleteOrder() {
        global $conn;
        $transactionId = $_POST['transaction_id'];
        $indiv_tour_id = $this->getIndividualTourId($transactionId);

        $query = "DELETE FROM TourDetails WHERE indiv_tour_id  = $indiv_tour_id";
        $conn->query($query);
        $query = "DELETE FROM Transactions WHERE transaction_id = '$transactionId'";
        $conn->query($query);
        $query = "DELETE FROM IndividualTour WHERE indiv_tour_id = $indiv_tour_id";
        $conn->query($query);
    }

    function deleteCustomer() {
        global $conn;
        $customer_id = $_POST['customer_id'];
        $indiv_tour_id = $_POST['individual_tour_id'];

        $query = "DELETE FROM TourDetails WHERE customer_id = $customer_id AND indiv_tour_id = $indiv_tour_id";
        $conn->query($query);
    }

    function updateCustomer() {
        global $conn;
        $customer_id = $_POST['customer_id'];
        $indiv_tour_id = $_POST['indiv_tour_id'];

        $fname = (empty($_POST['fname'])) ? NULL : $_POST['fname'];
        $lname = (empty($_POST['lname'])) ? NULL : $_POST['lname'];
        $phone = (empty($_POST['phone'])) ? NULL : $_POST['phone'];
        $other_contact_type = (empty($_POST['other_contact_number'])) ? NULL : $_POST['other_contact_type'];
        $other_contact_number = (empty($_POST['other_contact_number'])) ? NULL : $_POST['other_contact_number'];
        $birthday = (empty($_POST['birth_date'])) ? NULL : $_POST['birth_date'];
        $gender = (empty($_POST['gender'])) ? NULL : $_POST['gender'];
        $email = (empty($_POST['email'])) ? NULL : $_POST['email'];
        $zipcode = (empty($_POST['zipcode'])) ? NULL : $_POST['zipcode'];

        $join_date = (empty($_POST['join_date'])) ? NULL : $_POST['join_date'];
        $join_location = (empty($_POST['join_location'])) ? NULL : $_POST['join_location'];
        $leave_date = (empty($_POST['leave_date'])) ? NULL : $_POST['leave_date'];
        $leave_location = (empty($_POST['leave_location'])) ? NULL : $_POST['leave_location'];
        $note = (empty($_POST['note'])) ? NULL : $_POST['note'];

        $query = "UPDATE Customer SET
                    fname = '$fname',
                    lname = '$lname',
                    phone = '$phone',
                    other_contact_type = '$other_contact_type',
                    other_contact_number = '$other_contact_number',
                    birth_date = '$birthday',
                    gender = '$gender',
                    email = '$email',
                    zipcode = '$zipcode'
                  WHERE customer_id = $customer_id";
        $conn->query($query);

        $query = "UPDATE TourDetails
                  SET
                    join_date = '$join_date',
                    leave_date = '$leave_date',
                    join_location = '$join_location',
                    leave_location = '$leave_location',
                    note = '$note'
                  WHERE customer_id = $customer_id
                  AND indiv_tour_id = $indiv_tour_id";
        $conn->query($query);
    }
}


$IndividualTourEdit = new IndividualTourEdit();
if ($_GET['action'] == 'getDetail') {
    $result = $IndividualTourEdit->getOrderDetail($_GET['transaction_id']);
} else if ($_POST['action'] == 'updateOrder') {
    $IndividualTourEdit->updateOrder();
    $result = "Update successfully";
} else if ($_POST['action'] == 'deleteOrder') {
    $IndividualTourEdit->deleteOrder();
    $result = "Delete successfully";
} else if ($_GET['action'] == 'getCustomerList') {
    $result = $IndividualTourEdit->getCustomerList($_GET['transaction_id']);
} else if ($_POST['action'] == 'deleteCustomer') {
    $result = $IndividualTourEdit->deleteCustomer();
} else if ($_POST['action'] == 'updateCustomer') {
    $result = $IndividualTourEdit->updateCustomer();
}
echo $result;

mysqli_close($conn);
?>

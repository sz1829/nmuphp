<?php
include('../dbConnection.php');

class GroupOrderHistory {
    function getHistoryOrder() {
        global $conn;

        $transaction_id = (empty($_GET['transaction_id'])) ? '%' : $_GET['transaction_id'];
        $group_code = (empty($_GET['group_code'])) ? '%' : $_GET['group_code'];

        $status = json_decode($_GET['status']);

        $unClear = 'N';
        $clear = 'N';
        $lock = 'N';
        $statusFilter = "";

        for ($i = 0; $i < sizeof($status); $i++) {
            if ($status[$i] == 'unClear') {
                $unClear = 'Y';
            } else if ($status[$i] == 'clearOrder') {
                $clear = 'Y';
            } else if ($status[$i] == 'lockOrder') {
                $lock = 'Y';
            }
        }

        if ($unClear == 'Y' and $clear == 'N' and $lock == 'N') {
            $statusFilter = " AND g.clear_status = 'N' AND g.lock_status = 'N'";
        } else if ($unClear == 'N' and $clear == 'Y' and $lock == 'N') {
            $statusFilter = " AND g.clear_status = 'Y' AND g.lock_status = 'N'";
        } else if ($unClear == 'N' and $clear == 'Y' and $lock == 'Y') {
            $statusFilter = " AND g.clear_status = 'Y' AND g.lock_status = 'Y'";
        } else if ($unClear == 'Y' and $clear == 'Y' and $lock == 'N') {
            $statusFilter = " AND g.lock_status = 'N'";
        } else if ($unClear == 'Y' and $clear == 'Y' and $lock == 'Y') {
            $statusFilter = "";
        } else if ($unClear == 'N' and $clear == 'N' and $lock == 'Y') {
            $statusFilter = " AND g.clear_status = 'Y' AND g.lock_status = 'Y'";
        }

        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];

        $currency = $_GET['currency'];
        $secondCurrency = "RMB";
        if ($currency == 'RMB') {
            $secondCurrency = "USD";
        }

        $payment_type = $_GET['payment_type'];
        $salesperson = empty($_GET['salesperson']) ? '%' : $_GET['salesperson'];
        $source = empty($_GET['source']) ? '%' : $_GET['source'];
        $profit_min = empty($_GET['profit_min']) ? '-999999999.99' : $_GET['profit_min'];
        $profit_max = empty($_GET['profit_max']) ? '9999999.99' : $_GET['profit_max'];
        $cost_min = empty($_GET['cost_min']) ? '-999999999.99' : $_GET['cost_min'];
        $cost_max = empty($_GET['cost_max']) ? '99999999.99' : $_GET['cost_max'];
        $price_min = empty($_GET['price_min']) ? '-999999999.99' : $_GET['price_min'];
        $price_max = empty($_GET['price_max']) ? '99999999.99' : $_GET['price_max'];

        $total_number_min = empty($_GET['total_number_min']) ? '0' : $_GET['total_number_min'];
        $total_number_max = empty($_GET['total_number_max']) ? '999' : $_GET['total_number_max'];
        $flight_number = empty($_GET['flight_number']) ? '%' : $_GET['flight_number'];
        $bus_company = empty($_GET['bus_company']) ? '%' : $_GET['bus_company'];
        $agency = empty($_GET['agency_name']) ? '%' : $_GET['agency_name'];
        $tourist_guide = empty($_GET['tourist_guide']) ? '%' : $_GET['tourist_guide'];
        $start_date = empty($_GET['start_date']) ? '%' : $_GET['start_date'] . '%';
        $end_date = empty($_GET['end_date']) ? '%' : $_GET['end_date'] . '%';

        $commonSql = "SELECT
                        g.transaction_id, g.create_time, g.salesperson_code, g.currency, g.payment_type,
                        g.profit, g.price, g.cost, t.expense, t.received+t.received2 as revenue,
                        c.code, g.coupon, g.source_name, g.clear_status, g.lock_status, g.note,
                        g.group_code, g.total_number, g.flight_number, g.bus_company, g.schedule, g.guide_name, g.guide_phone, g.agency_name
                FROM GroupTourOrder g
                JOIN Transactions t
                    ON g.transaction_id = t.transaction_id
                LEFT JOIN CouponCode c
                    ON t.cc_id = c.cc_id
                JOIN GroupTour gt
                    ON t.group_tour_id = gt.group_tour_id
                WHERE
                    g.transaction_id LIKE '$transaction_id'
                AND g.group_code LIKE '$group_code'";
        $commonSql .= $statusFilter;
        $commonSql .= " AND g.create_time >= '$from_date'
                  AND g.create_time < '$to_date'
                  AND g.payment_type LIKE '$payment_type'
                  AND g.salesperson_code LIKE '$salesperson'
                  AND g.source_name LIKE '$source'
                  AND g.total_number BETWEEN $total_number_min AND $total_number_max
                  AND g.flight_number LIKE '$flight_number'
                  AND g.bus_company LIKE '$bus_company'
                  AND g.agency_name LIKE '$agency'
                  AND gt.start_date LIKE '$start_date'
                  AND gt.end_date LIKE '$end_date'
                  AND guide_name LIKE '$tourist_guide'";

        $firstSql = "SELECT * FROM ("
                    . $commonSql
                    . ") first_filter
                        WHERE first_filter.currency = '$currency'
                        AND first_filter.payment_type LIKE '$payment_type'
                        AND first_filter.profit BETWEEN $profit_min AND $profit_max
                        AND first_filter.expense BETWEEN $cost_min AND $cost_max
                        AND first_filter.revenue BETWEEN $price_min AND $price_max";

        $secondSql = "SELECT * FROM (" . $commonSql;
        if ($secondCurrency == 'RMB') {
            $secondSql .= ") first_filter
                            WHERE first_filter.currency = '$secondCurrency'
                            AND first_filter.payment_type LIKE '$payment_type'
                            AND first_filter.profit BETWEEN
                                                            $profit_min * (SELECT value FROM OtherInfo WHERE type = 'currency')
                                                          AND
                                                            $profit_max * (SELECT value FROM OtherInfo WHERE type = 'currency')
                            AND first_filter.expense BETWEEN
                                                            $cost_min * (SELECT value FROM OtherInfo WHERE type = 'currency')
                                                          AND
                                                            $cost_max * (SELECT value FROM OtherInfo WHERE type = 'currency')
                            AND first_filter.revenue BETWEEN
                                                            $price_min * (SELECT value FROM OtherInfo WHERE type = 'currency')
                                                          AND
                                                            $price_max * (SELECT value FROM OtherInfo WHERE type = 'currency')";
        } else if ($secondCurrency == 'USD') {
            $secondSql .= ") first_filter
                            WHERE first_filter.currency = '$secondCurrency'
                            AND first_filter.payment_type LIKE '$payment_type'
                            AND first_filter.profit BETWEEN
                                                            $profit_min / (SELECT value FROM OtherInfo WHERE name = 'default_currency')
                                                          AND
                                                            $profit_max / (SELECT value FROM OtherInfo WHERE name = 'default_currency')
                            AND first_filter.expense BETWEEN
                                                            $cost_min / (SELECT value FROM OtherInfo WHERE name = 'default_currency')
                                                          AND
                                                            $cost_max / (SELECT value FROM OtherInfo WHERE name = 'default_currency')
                            AND first_filter.revenue BETWEEN
                                                            $price_min / (SELECT value FROM OtherInfo WHERE name = 'default_currency')
                                                          AND
                                                            $price_max / (SELECT value FROM OtherInfo WHERE name = 'default_currency')";
        }

        $sql = "SELECT * FROM (" . $firstSql . " UNION " . $secondSql . ") second_filter ORDER BY second_filter.transaction_id DESC";

        $result = $conn->query($sql);

        $res = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res[] = $row;
            }
        }

        return json_encode($res);
    }
}

$groupOrder = new GroupOrderHistory();
if ($_GET['action'] == 'getHistoryOrder') {
    $result = $groupOrder->getHistoryOrder();
}

echo $result;


mysqli_close($conn);
?>

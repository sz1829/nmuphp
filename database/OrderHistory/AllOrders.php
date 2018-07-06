<?php
include('../dbConnection.php');

class AllOrderHistory {
    function getHistoryOrder() {
        global $conn;

        $transaction_id = (empty($_GET['transaction_id'])) ? '%' : $_GET['transaction_id'];

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
            $statusFilter = " AND clear_status = 'N' AND lock_status = 'N'";
        } else if ($unClear == 'N' and $clear == 'Y' and $lock == 'N') {
            $statusFilter = " AND clear_status = 'Y' AND lock_status = 'N'";
        } else if ($unClear == 'N' and $clear == 'Y' and $lock == 'Y') {
            $statusFilter = " AND clear_status = 'Y' AND lock_status = 'Y'";
        } else if ($unClear == 'Y' and $clear == 'Y' and $lock == 'N') {
            $statusFilter = " AND lock_status = 'N'";
        } else if ($unClear == 'Y' and $clear == 'Y' and $lock == 'Y') {
            $statusFilter = "";
        } else if ($unClear == 'N' and $clear == 'N' and $lock == 'Y') {
            $statusFilter = " AND clear_status = 'Y' AND lock_status = 'Y'";
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

        $commonSql = "SELECT
                    t.transaction_id, t.currency, DATE_FORMAT(t.create_time, '%Y-%m-%d') AS create_time, s.salesperson_code,
                    t.total_profit, t.received+t.received2 AS revenue, t.expense, c.code,
                    t.coupon, cs.source_name, t.clear_status, t.lock_status, t.note
                FROM Transactions t
                LEFT JOIN CouponCode c
                    ON t.cc_id = c.cc_id
                JOIN CustomerSource cs
                    ON t.source_id = cs.source_id
                JOIN Salesperson s
                    ON t.salesperson_id = s.salesperson_id
                WHERE
                    t.transaction_id LIKE '$transaction_id'";
        $commonSql .= $statusFilter;
        $commonSql .= " AND t.create_time >= '$from_date'
                  AND t.create_time < '$to_date'
                  AND t.payment_type LIKE '$payment_type'
                  AND s.salesperson_code LIKE '$salesperson'
                  AND cs.source_name LIKE '$source'";

        $firstSql = "SELECT * FROM ("
                    . $commonSql
                    . ") first_filter
                        WHERE first_filter.currency = '$currency'
                        AND first_filter.total_profit BETWEEN $profit_min AND $profit_max
                        AND first_filter.expense BETWEEN $cost_min AND $cost_max
                        AND first_filter.revenue BETWEEN $price_min AND $price_max";

        $secondSql = "SELECT * FROM (" . $commonSql;
        if ($secondCurrency == 'RMB') {
            $secondSql .= ") first_filter
                            WHERE first_filter.currency = '$secondCurrency'
                            AND first_filter.total_profit BETWEEN
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
                            AND first_filter.total_profit BETWEEN
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

$allOrderHistory = new AllOrderHistory();
if ($_GET['action'] == 'getHistoryOrder') {
    $result = $allOrderHistory->getHistoryOrder();
}

echo $result;


mysqli_close($conn);
?>

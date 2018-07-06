<?php
include('../dbConnection.php');

class IndivOrderHistory {
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
            $statusFilter = " AND it.clear_status = 'N' AND it.lock_status = 'N'";
        } else if ($unClear == 'N' and $clear == 'Y' and $lock == 'N') {
            $statusFilter = " AND it.clear_status = 'Y' AND it.lock_status = 'N'";
        } else if ($unClear == 'N' and $clear == 'Y' and $lock == 'Y') {
            $statusFilter = " AND it.clear_status = 'Y' AND it.lock_status = 'Y'";
        } else if ($unClear == 'Y' and $clear == 'Y' and $lock == 'N') {
            $statusFilter = " AND it.lock_status = 'N'";
        } else if ($unClear == 'Y' and $clear == 'Y' and $lock == 'Y') {
            $statusFilter = "";
        } else if ($unClear == 'N' and $clear == 'N' and $lock == 'Y') {
            $statusFilter = " AND it.clear_status = 'Y' AND it.lock_status = 'Y'";
        }

        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];

        $currency = $_GET['currency'];

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
        $group_name = empty($_GET['group_name']) ? '%' : $_GET['group_name'];
        $wholesaler = empty($_GET['wholesaler']) ? '%' : $_GET['wholesaler'];
        $start_date = empty($_GET['start_date']) ? '%' : $_GET['start_date'] . '%';
        $end_date = empty($_GET['end_date']) ? '%' : $_GET['end_date'] . '%';

        $sql = "SELECT
                    it.transaction_id, it.create_time, it.salesperson_code, it.currency,
                    it.total_profit, it.revenue, it.cost, it.coupon,
                    it.source_name, it.clear_status, it.lock_status, it.note,
                    it.tour_name, it.product_code, it.indiv_number, it.schedule, it.wholesaler_code
                FROM IndividualTourOrder it
                JOIN Transactions t
                ON it.transaction_id = t.transaction_id
                JOIN IndividualTour i
                ON t.indiv_tour_id = i.indiv_tour_id
                WHERE it.transaction_id LIKE '$transaction_id'";
        $sql .= $statusFilter;
        $sql .= " AND t.create_time >= '$from_date'
                AND t.create_time <= '$to_date'
                AND it.salesperson_code LIKE '$salesperson'
                AND it.source_name LIKE '$source'
                AND it.product_code LIKE '$group_code'
                AND it.indiv_number >= $total_number_min
                AND it.indiv_number <= $total_number_max
                AND i.depart_date LIKE '$start_date'
                AND i.arrival_date LIKE '$end_date'
                AND it.tour_name LIKE '$group_name'
                AND it.wholesaler_code LIKE '$wholesaler'
                AND it.total_profit BETWEEN $profit_min AND $profit_max
                AND it.cost BETWEEN $cost_min AND $cost_max
                AND it.revenue BETWEEN $price_min AND $price_max
                ORDER BY t.transaction_id DESC";
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

$indivOrder = new IndivOrderHistory();
if ($_GET['action'] == 'getHistoryOrder') {
    $result = $indivOrder->getHistoryOrder();
}

echo $result;


mysqli_close($conn);
?>

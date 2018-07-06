<?php
include('../dbConnection.php');

class SummaryPerformance {
    function getSummaryReport() {
        global $conn;

        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];

        $sql = "CALL sum_profit('monthly', '%', '$startDate', '$endDate')";
        $result = $conn->query($sql);

        $res = array();
        $period = array();
        $group_sum = array();
        $indiv_sum = array();
        $airticket_sum = array();
        $total_sum = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $period[] = $row['time_period'];
                $group_sum[] = $row['groupSum'];
                $indiv_sum[] = $row['indivSum'];
                $airticket_sum[] = $row['airSum'];
                $total_sum[] = $row['totalSum'];
            }
        }

        array_push($res, $period);
        array_push($res, $group_sum);
        array_push($res, $indiv_sum);
        array_push($res, $airticket_sum);
        array_push($res, $total_sum);
        return json_encode($res);
    }

    function getSalesPerformance() {
        global $conn;

        $timeFilter = $_POST['time_filter'];
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        $salesperson = empty($_POST['salesperson']) ? '%' : $_POST['salesperson'];

        $sql = "CALL sum_profit('$timeFilter', '$salesperson', '$startDate', '$endDate')";
        $result = $conn->query($sql);

        $res = array();
        $period = array();
        $group_sum = array();
        $indiv_sum = array();
        $airticket_sum = array();
        $total_sum = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $period[] = $row['time_period'];
                $group_sum[] = $row['groupSum'];
                $indiv_sum[] = $row['indivSum'];
                $airticket_sum[] = $row['airSum'];
                $total_sum[] = $row['totalSum'];
            }
        }

        array_push($res, $period);
        array_push($res, $group_sum);
        array_push($res, $indiv_sum);
        array_push($res, $airticket_sum);
        array_push($res, $total_sum);
        return json_encode($res);
    }
}

$summaryPerformance = new SummaryPerformance();
if ($_POST['action'] == 'getSummaryReport') {
    $result = $summaryPerformance->getSummaryReport();
} else if ($_POST['action'] == 'getSalesPerformance') {
    $result = $summaryPerformance->getSalesPerformance();
}
echo $result;

mysqli_close($conn);
?>

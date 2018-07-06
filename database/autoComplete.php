<?php include('dbConnection.php');

class AutoComplete {
    function getSalesperson() {
        global $conn;
        $query = "SELECT salesperson_code FROM Salesperson";
        $result = $conn->query($query);
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row['salesperson_code'];
            }
        }
        return json_encode($rows);
    }

    function getSalespersonName() {
        global $conn;
        $query = "SELECT concat(fname, ' ', lname) as name FROM Salesperson";
        $result = $conn->query($query);
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row['name'];
            }
        }
        return json_encode($rows);
    }

    function getSource() {
        global $conn;
        $query = "SELECT source_name FROM CustomerSource";
        $result =  $conn->query($query);
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row['source_name'];
            }
        }
        return json_encode($rows);
    }

    function getTouristGuide() {
        global $conn;
        // $conn->set_charset("utf8");
        $guideName = "";
        $query = "SELECT fname, lname FROM TouristGuide";
        $result =  $conn->query($query);
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row['lname'] == NULL) {
                    $guideName = $row['fname'];
                } else {
                    $guideName = $row['fname'] . " " . $row['lname'];
                }
                $rows[] = $guideName;
            }
        }
        return json_encode($rows);
    }

    function getWholesaler() {
        global $conn;
        $query = "SELECT wholesaler_code FROM Wholesaler";
        $result =  $conn->query($query);
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row['wholesaler_code'];
            }
        }
        return json_encode($rows);
    }

    function getWholesalerName() {
        global $conn;
        $query = "SELECT name FROM Wholesaler";
        $result =  $conn->query($query);
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row['name'];
            }
        }
        return json_encode($rows);
    }

    function getWholesalerContactPerson() {
        global $conn;
        $query = "SELECT contact_person FROM Wholesaler";
        $result =  $conn->query($query);
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row['contact_person'];
            }
        }
        return json_encode($rows);
    }
}

$target = $_POST['target'];
// echo $target;
$autoComplete = new AutoComplete();
$result = array();
if ($target == 'salesperson') {
    $result = $autoComplete->getSalesperson();
} else if ($target == 'source') {
    $result = $autoComplete->getSource();
} else if ($target == 'touristGuide') {
    $result = $autoComplete->getTouristGuide();
} else if ($target == 'wholesaler') {
    $result = $autoComplete->getWholesaler();
} else if ($target == 'wholesaler_name') {
    $result = $autoComplete->getWholesalerName();
} else if ($target == 'wholesaler_contact_person') {
    $result = $autoComplete->getWholesalerContactPerson();
} else if ($target == 'salesperson_name') {
    $result = $autoComplete->getSalespersonName();
}
echo $result;

mysqli_close($conn);
 ?>

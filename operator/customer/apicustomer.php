<?php
include '../../databaseconnect/connect.php';

$sql = "SELECT * FROM `tbl_customer`";
$result = mysqli_query($con, $sql);

$customerList = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $customerList[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'merk' => $row['merk'],
            'price' => $row['price'],
            'amount' => $row['amount'],
            'total_price' => $row['total_price'],
            'date' => $row['date']
        );
    }

    header('Content-Type: application/json');
    echo json_encode($customerList);
} else {
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(array('message' => 'Failed to retrieve customer data'));
}
?>

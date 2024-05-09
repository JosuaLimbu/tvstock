<?php
include '../../databaseconnect/connect.php';

$sql = "SELECT * FROM `tbl_stock`";
$result = mysqli_query($con, $sql);

$stockList = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $stockList[] = array(
            'id' => $row['id'],
            'merk' => $row['merk'],
            'price' => $row['price'],
            'available' => $row['available'],
        );
    }

    header('Content-Type: application/json');
    echo json_encode($stockList);
} else {
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(array('message' => 'Failed to retrieve stock data'));
}
?>

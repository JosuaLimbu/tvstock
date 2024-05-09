<?php
include '../index.php';
// Fetch price based on the selected brand
if (isset($_POST['merk'])) {
    $selectedMerk = $_POST['merk'];

    // Assuming you have a database connection already established
    include '../../databaseconnect/connect.php';

    // Query to retrieve price based on the selected brand
    $sql = "SELECT price FROM tbl_stock WHERE merk = '$selectedMerk'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $price = $row['price'];
        echo json_encode(['status' => 'success', 'price' => $price]);
    } else {
        echo json_encode(['status' => 'error']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
?>
<?php

include '../../databaseconnect/connect.php';

$sql = "SELECT * FROM `tbl_account`";
$result = mysqli_query($con, $sql);

$accountList = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $accountList[] = array(
            'id' => $row['id'],
            'username' => $row['username'],
            'role' => $row['role'],
            'create_date' => $row['create_at']
        );
    }

    header('Content-Type: application/json');
    echo json_encode($accountList);
} else {
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(array('message' => 'Failed to retrieve account data'));
}
?>

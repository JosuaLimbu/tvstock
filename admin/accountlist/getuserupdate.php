<?php
include '../index.php';
include '../../databaseconnect/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $sql = "SELECT `username` FROM `tbl_account` WHERE `id` = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            $id = $_POST['id'];
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $username);
                if (mysqli_stmt_fetch($stmt)) {
                    echo json_encode(['username' => $username]);
                } else {
                    echo json_encode(['error' => 'User not found.']);
                }
            } else {
                echo json_encode(['error' => 'Failed to execute statement.']);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(['error' => 'Failed to prepare statement.']);
        }
    } else {
        echo json_encode(['error' => 'User ID is missing.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>

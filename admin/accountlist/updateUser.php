<?php
include '../index.php';
include '../../databaseconnect/connect.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    $createDate = date("d F Y");

    // hindari sql inject
    $stmt = $con->prepare("SELECT * FROM tbl_account WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // hindari sql inject
        $stmt = $con->prepare("UPDATE tbl_account SET username=?, password=?, create_at=? WHERE id=?");
        $stmt->bind_param("sssi", $newUsername, $newPassword, $createDate, $id);

        if ($stmt->execute()) {
            echo "Username & Password updated successfully";
        } else {
            echo $stmt->error;
        }
    } else {
        echo "Current password is incorrect";
    }

    // Close statement
    $stmt->close();
}

$con->close();
?>
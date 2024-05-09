<?php
include '../index.php';
include '../../databaseconnect/connect.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengurangi resiko SQL injection
    $id = $_POST['id'];
    $newmerk = $_POST['newmerk'];
    $newprice = $_POST['newprice'];
    $newavailable = $_POST['newavailable'];

    $stmt = $con->prepare("SELECT * FROM tbl_stock WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // mengurangi resiko sql inject
        $stmt = $con->prepare("UPDATE tbl_stock SET merk=?, price=?, available=? WHERE id=?");
        $stmt->bind_param("siii", $newmerk, $newprice, $newavailable, $id);

        if ($stmt->execute()) {
            echo "TV Stock updated successfully";
        } else {
            echo "Error update TV Stock: " . $stmt->error;
        }
    } else {
        echo "TV Stock updated error";
    }


    $stmt->close();
}

$con->close();
?>
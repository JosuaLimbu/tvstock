<?php
include '../index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../databaseconnect/connect.php';

    $username = $_SESSION["username"];
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];

    $query = "SELECT * FROM tbl_account WHERE username='$username' AND password='$oldPassword'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $updateQuery = "UPDATE tbl_account SET password='$newPassword' WHERE username='$username'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Password Changed Successfully";
        } else {
            echo "Error: " . $updateQuery . "<br>" . mysqli_error($con);
        }
    } else {
        echo "Old Password Incorrect";
    }

    mysqli_close($con);
} else {
    echo "Metode pengiriman data bukan POST!";
}
?>
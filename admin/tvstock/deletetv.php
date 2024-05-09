<?php
include '../index.php';
include '../../databaseconnect/connect.php';

if (isset($_POST["action"])) {
    if ($_POST["action"] == "delete") {
        delete();
    }
}

function delete()
{
    global $con;

    $id = $_POST["id"];

    // mengurangi resiko sql injection
    $query = "DELETE FROM tbl_stock WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo 1;
    } else {
        echo "ada yang salah";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
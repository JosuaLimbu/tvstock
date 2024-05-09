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

    $id = mysqli_real_escape_string($con, $_POST["id"]);

    $query = "DELETE FROM tbl_account WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo 1;
    } else {
        echo "ada yang salah";
    }
}
?>
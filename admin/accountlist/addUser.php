<?php
include '../index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../databaseconnect/connect.php';

    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $role = mysqli_real_escape_string($con, $_POST["role"]);
    $createDate = date("d F Y");

    $check_query = "SELECT * FROM tbl_account WHERE username = ?";
    $stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($check_result) > 0) {
        echo json_encode(array("status" => "error", "message" => "Username sudah ada di database!"));
        exit;
    }

    $sql_min_id = "SELECT MIN(t1.id) + 1 AS smallest_empty_id
                   FROM tbl_account AS t1
                   LEFT JOIN tbl_account AS t2 ON t1.id + 1 = t2.id
                   WHERE t2.id IS NULL";
    $result_min_id = mysqli_query($con, $sql_min_id);
    $row_min_id = mysqli_fetch_assoc($result_min_id);
    $new_id = $row_min_id['smallest_empty_id'];


    $sql = "INSERT INTO tbl_account (id, username, password, role, create_at) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "issss", $new_id, $username, $password, $role, $createDate);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Terjadi kesalahan saat menambahkan data!"));
    }

    mysqli_close($con);
} else {
    echo json_encode(array("status" => "error", "message" => "Metode pengiriman data bukan POST!"));
}

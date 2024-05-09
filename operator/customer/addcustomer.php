<?php
include '../index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../databaseconnect/connect.php';

    $name = $_POST["name"];
    $merk = $_POST["merk"];
    $price = $_POST["price"];
    $amount = $_POST["amount"];
    $total_price = $_POST["total_price"];

    $currentDateTime = date('j F Y');

    $sql_min_id = "SELECT MIN(t1.id) + 1 AS smallest_empty_id
                   FROM tbl_customer AS t1
                   LEFT JOIN tbl_customer AS t2 ON t1.id + 1 = t2.id
                   WHERE t2.id IS NULL";
    $result_min_id = mysqli_query($con, $sql_min_id);
    $row_min_id = mysqli_fetch_assoc($result_min_id);
    $new_id = $row_min_id['smallest_empty_id'];

    $sql_stock = "SELECT available FROM tbl_stock WHERE merk = '$merk'";
    $result_stock = mysqli_query($con, $sql_stock);
    $row_stock = mysqli_fetch_assoc($result_stock);
    $available_stock = $row_stock['available'];

    $updated_stock = $available_stock - $amount;

    $sql_update_stock = "UPDATE tbl_stock SET available = '$updated_stock' WHERE merk = '$merk'";
    mysqli_query($con, $sql_update_stock);

    $sql = "INSERT INTO tbl_customer (id, name, merk, price, amount, total_price, date) VALUES ('$new_id', '$name', '$merk', '$price', '$amount', '$total_price', '$currentDateTime')";

    if (mysqli_query($con, $sql)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Terjadi kesalahan saat menambahkan data!"));
    }

    mysqli_close($con);
} else {
    echo json_encode(array("status" => "error", "message" => "Metode pengiriman data bukan POST!"));
}
?>
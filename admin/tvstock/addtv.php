<?php
session_start();
include '../index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../databaseconnect/connect.php';

    $merk = $_POST["merk"];
    $price = $_POST["price"];
    $available = $_POST["available"];

    // Mengambil ID terkecil yang belum terpakai
    $sql_min_id = "SELECT MIN(t1.id) + 1 AS smallest_empty_id
                   FROM tbl_stock AS t1
                   LEFT JOIN tbl_stock AS t2 ON t1.id + 1 = t2.id
                   WHERE t2.id IS NULL";
    $result_min_id = mysqli_query($con, $sql_min_id);

    if ($result_min_id) {
        $row_min_id = mysqli_fetch_assoc($result_min_id);
        $new_id = $row_min_id['smallest_empty_id'];

        // mengurangi SQL Injection
        $stmt = $con->prepare("INSERT INTO tbl_stock (id, merk, price, available) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $new_id, $merk, $price, $available);

        if ($stmt->execute()) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Terjadi kesalahan saat menambahkan data!"));
        }
        $stmt->close();
    } else {
        echo json_encode(array("status" => "error", "message" => "Terjadi kesalahan saat mengambil ID yang tersedia!"));
    }

    mysqli_close($con);
} else {
    echo json_encode(array("status" => "error", "message" => "Metode pengiriman data bukan POST!"));
}
?>
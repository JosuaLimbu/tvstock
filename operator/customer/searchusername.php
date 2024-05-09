<?php
include '../index.php';
include '../../databaseconnect/connect.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$keyword = $_POST['keyword'];

if (empty($keyword)) {
    $sql = "SELECT * FROM tbl_customer";
} else {
    $sql = "SELECT * FROM tbl_customer WHERE name LIKE '%$keyword%'";
}

$result = $con->query($sql);

$count = $result->num_rows;

if ($count > 0) {
    // Simpan hasil query ke dalam array
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Tampilkan data dari array dalam urutan terbalik, tetapi nomor urut tetap berurutan
    for ($i = $count - 1; $i >= 0; $i--) {
        echo '<tr>
                <td>' . ($count - $i) . '</td>
                <td>' . $rows[$i]['name'] . '</td>
                <td>' . $rows[$i]['merk'] . '</td>
                <td>Rp. ' . number_format($rows[$i]['price'], 0, ',', '.') . ',-</td>
                <td>' . $rows[$i]['amount'] . '</td>
                <td>Rp. ' . number_format($rows[$i]['total_price'], 0, ',', '.') . ',-</td>
                <td>' . $rows[$i]['date'] . '</td>
            </tr>';
    }
} else {
    echo '<tr><td colspan="5">No records found</td></tr>';
}

$con->close();
?>
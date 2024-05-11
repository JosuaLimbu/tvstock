<?php
$con = new mysqli('localhost', 'j05u4l!m13u', 'QfXpdljS%_2024', 'db_tvstock');
// $con = new mysqli('localhost', 'root', 'limbujosua23', 'db_tvstock');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    //echo "Connection successful";
}

// Query untuk mengambil data dari tabel tbl_account
$sql = "SELECT * FROM tbl_account";
$result = $conn->query($sql);

// Memeriksa apakah ada hasil yang dikembalikan
if ($result->num_rows > 0) {
    // Membuat array kosong untuk menyimpan hasil
    $response = array();

    // Memasukkan setiap baris hasil ke dalam array response
    while($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    // Mengubah array response menjadi format JSON
    echo json_encode($response);
} else {
    // Jika tidak ada hasil yang dikembalikan
    echo "0 results";
}

// Menutup koneksi database
$conn->close();
?>

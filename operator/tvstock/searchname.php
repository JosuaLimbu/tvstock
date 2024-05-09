<?php
include '../index.php';
include '../../databaseconnect/connect.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$keyword = $_POST['keyword'];

if (empty($keyword)) {
    $sql = "SELECT * FROM tbl_stock";
} else {
    $sql = "SELECT * FROM tbl_stock WHERE merk LIKE ?";
}

// Prepare statement
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error in preparing statement: " . $con->error);
}

// Bind parameters
if (!empty($keyword)) {
    $keyword = "%" . $keyword . "%";
    $stmt->bind_param("s", $keyword);
}

// Execute statement
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['merk'] . '</td>
                <td>Rp. ' . number_format($row['price'], 0, ',', '.') . ',-</td>
                <td>' . $row['available'] . ' unit</td>
            </tr>';
    }
} else {
    echo '<tr><td colspan="5">No records found</td></tr>';
}

$stmt->close();
$con->close();
?>
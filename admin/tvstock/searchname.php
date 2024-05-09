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
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_' . $row['id'] . '" data-bs-toggle="dropdown" aria-expanded="false">
                            Options
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_' . $row['id'] . '">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="' . $row['id'] . '" onclick="iddata(' . $row['id'] . ')" data-role="update">Update</a></li>
                            <li><a class="dropdown-item delete-account" href="#" data-id="' . $row['id'] . '" onclick="deletedata(' . $row['id'] . ')"> Delete</a></li>
                        </ul>
                    </div>
                    <button id="updateButton_' . $row['id'] . '" class="btn btn-info mt-1" style="display: none;" onclick="iddata(' . $row['id'] . ')">Update</button>
                    <button id="deleteButton_' . $row['id'] . '" class="btn btn-danger mt-1" style="display: none;" onclick="deletedata(' . $row['id'] . ')">Delete</button>
                </td>
            </tr>';
    }
} else {
    echo '<tr><td colspan="5">No records found</td></tr>';
}

$stmt->close();
$con->close();
?>
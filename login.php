<?php
session_start();

function processLogin($role, $username, $password, $con)
{
    $sql = "SELECT * FROM tbl_account WHERE role=? AND BINARY username=? AND password=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $role, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        return array("success" => true, "message" => "Login successful.");
    } else {
        return array("success" => false, "message" => "Incorrect username or password.");
    }
}

$error_message = '';
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If Content-Type is application/json, treat it as an API request
    if ($_SERVER["CONTENT_TYPE"] == "application/json") {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        include 'databaseconnect/connect.php';

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $username = $data['username'];
        $password = $data['password'];
        $role = $data['role'];

        $response = processLogin($role, $username, $password, $con);

        $con->close();

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else { // For web-based login
        include 'databaseconnect/connect.php';

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $error_message = processLogin($role, $username, $password, $con);

        $con->close();
    }
}
?>

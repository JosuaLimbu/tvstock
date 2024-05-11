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
        if ($role == 'admin') {
            header("Location: $role/home/home.php");
        } elseif ($role == 'operator') {
            header("Location: $role/home/home.php");
        }
    } else {
        return "Incorrect username or password.";
    }
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TVStock</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/png" href="img/tvstock.png">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1>Sign In</h1> <br>
                <select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
                <div class="input-container">
                    <img src="img/usericon.svg" alt="Username Icon">
                    <input type="username" name="username" placeholder="Username" required />
                </div>
                <div class="input-container">
                    <img src="img/passicon.svg" alt="Password Icon">
                    <input type="password" name="password" id="password" placeholder="Password" required />
                    <i class="far fa-eye-slash" id="togglePassword"></i>
                </div>
                <?php if (!empty($error_message)) { ?>
                    <p class="err">
                        <?php echo $error_message; ?>
                    </p>
                <?php } ?>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img src="img/tvstock.png" alt="">
                    <p class="textright">PUAN</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        function blockRightClick(event) {
            event.preventDefault();
        }

        document.addEventListener('contextmenu', blockRightClick);

        function blockShortcuts(event) {
            if (event.ctrlKey || event.altKey || event.metaKey) {
                event.preventDefault();
            }
        }
        document.addEventListener('keydown', blockShortcuts);

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            if (type === 'password') {
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    </script>


</body>

</html>
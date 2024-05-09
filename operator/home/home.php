<?php
include '../index.php';
$page = 'home'; //buat page aktif di sidebar

// Koneksi ke database
include '../../databaseconnect/connect.php';
$current_date = date("d F Y");
$query = "SELECT COUNT(*) AS total_customers FROM tbl_customer WHERE date = DATE_FORMAT(NOW(), '%d %M %Y')";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$total_customers_today = $row['total_customers'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="../../img/tvstock.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<style>
    :root {
        --blue: #194376;
    }

    a {
        text-decoration: none;
    }
</style>

<body style="background-color: #dedede;">
    <?php include '../components/sidebar/sidebar.php'; ?>
    <!-- CONTENT -->
    <section id="content">
        <!-- Include navbar -->
        <?php include '../components/navbar/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <!-- Main content -->
            <div class="head-title">
                <div class="left" style="font-family: 'Montserrat', sans-serif; font-weight: 600">
                    <p>Home</p>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <span class="text">
                        <h3>Welcome</h3>
                        <p>
                            <?php echo $_SESSION["username"]; ?>
                        </p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-tv'></i>
                    <span class="text">
                        <h3 style="font-size: 22px;">
                            <?php echo $total_customers_today; ?> Customer
                        </h3>
                        <p>Transactions Today</p>
                        <!-- Added output of total_customers_today -->
                    </span>
                </li>
                <li>
                    <i class='bx bxs-time-five'></i>
                    <span class="text">
                        <h3 id="current-time"></h3>
                        <p id="current-date"></p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>About TVStock</h3>
                    </div>
                    <span class="text">
                        <p>TVStock is an online platform designed to provide comprehensive data storage and
                            management services related to mobile device stocks. With a focus on the
                            telecommunications industry, TVStock enables users, especially retailers and
                            mobile device distributors, to efficiently and effectively manage their inventory.
                            Through features such as search, addition, deletion, and data updates, TVStock allows
                            users to organize their stocks more efficiently and accurately. Additionally,
                            tvstock also provides various up-to-date information regarding market trends, prices,
                            and the latest offers in the mobile industry, helping users make better decisions
                            in their business operations. Thus, tvstock aims to be a reliable partner in inventory
                            management and maintaining competitiveness in the mobile device industry.</p>
                    </span>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>

</body>

</html>
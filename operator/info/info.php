<?php
include '../index.php';
$page = 'info'; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <link rel="icon" type="image/png" href="../../img/tvstock.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="info.css">
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
                    <p>Info</p>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>TVStock</h3>
                    </div>
                    <span class="text">
                        <p>TVStock is an online platform designed to provide comprehensive data storage and
                            management services related to mobile device stocks. With a focus on the telecommunications
                            industry, TVStock enables users, especially retailers and mobile device distributors,
                            to efficiently and effectively manage their inventory. Through features such as search,
                            addition, deletion, and data updates, TVStock allows users to organize their stocks more
                            efficiently and accurately. Additionally, TVStock also provides various up-to-date
                            information
                            regarding market trends, prices, and the latest offers in the mobile industry, helping users
                            make better decisions in their business operations. Thus, TVStock aims to be a reliable
                            partner in inventory management and maintaining competitiveness in the mobile device
                            industry. <br>
                            For information, assistance, or how to use, please contact <a
                                href="https://wa.me/6285756958367">+62857 5695 8367</a>.
                        <p style="text-align: center;">©2024 DevOps All rights
                            reserved.</p>
                        </p>
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
<section id="sidebar" style="z-index: 1040;">
    <a href="#" class="brand" style="text-decoration : none;">
        <img src="../../img/tvstock.png" alt="" srcset="">
        <span class="text">TVSTOCK</span>
    </a>
    <ul class="side-menu top">
        <li <?php if ($page == 'home')
            echo 'class="active"'; ?>>
            <a href="../home/home.php" style="text-decoration : none;">
                <i class='bx bx-home'></i>
                <span class="text">Home</span>
            </a>
        </li>
        <li <?php if ($page == 'customer')
            echo 'class="active"'; ?>>
            <a href="../customer/customer.php" style="text-decoration : none;">
                <i class='bx bxs-user-detail'></i>
                <span class="text">Customer</span>
            </a>
        </li>
        <li <?php if ($page == 'tvstock')
            echo 'class="active"'; ?>>
            <a href="../tvstock/tvstock.php" style="text-decoration : none;">
                <i class='bx bx-tv'></i>
                <span class="text">TV Stock</span>
            </a>
        </li>
        <li <?php if ($page == 'info')
            echo 'class="active"'; ?>>
            <a href="../info/info.php" style="text-decoration : none;">
                <i class='bx bx-info-circle'></i>
                <span class="text">Info</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="../../logout.php" class="logout" style="text-decoration : none;">
                <i class='bx bx-log-out'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
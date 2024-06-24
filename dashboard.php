<?php
    session_start();

    if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
        header("HTTP/1.0 404 Not Found");
        echo "Page not found";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Meterial Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- ---- Dashboard CSS ---- -->
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>
    <div class="grid-container">
        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>

            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>

            <div class="header-right">
                <a href="index.php">
                    <span class="material-icons-outlined">home</span>
                </a>
                <span class="material-icons-outlined">notifications</span>
                <span class="material-icons-outlined">email</span>
                <span class="material-icons-outlined">account_circle</span>
            </div>
        </header>
        <!-- End header -->

        <!-- Sidebar -->
        <?php
            include 'dashboard_sidebar.php'
        ?>
        <!-- End sidebar -->

        <!-- Main -->
        <main class="main-container">
            <div class="main-title">
                <h2>BẢNG ĐIỀU KHIỂN</h2>
            </div>

            <div class="main-cards">
                <div class="card">
                    <div class="card-inner">
                        <h3>SẢN PHẨM</h3>
                        <span class="material-icons-outlined"> inventory_2 </span>
                    </div>
                    <h1>40</h1>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <h3>DANH MỤC</h3>
                        <span class="material-icons-outlined"> category </span>
                    </div>
                    <h1>8</h1>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <h3>KHÁCH HÀNG</h3>
                        <span class="material-icons-outlined"> group </span>
                    </div>
                    <h1>200</h1>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <h3>ĐƠN HÀNG</h3>
                        <span class="material-icons-outlined"> fact_check </span>
                    </div>
                    <h1>12</h1>
                </div>
            </div>

            <div class="charts">
                <div class="charts-card">
                    <h2 class="chart-title">Top 5 sản phẩm</h2>
                    <div id="bar-chart"></div>
                </div>

                <div class="charts-card">
                    <h2 class="chart-title">Đơn mua và bán hàng</h2>
                    <div id="area-chart"></div>
                </div>
            </div>
        </main>
        <!-- End main -->

    </div>

    <!-- Script -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.js"></script>

    <!-- ---Custom JS -->
    <script src="./js/dashboard.js"></script>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION["mahasiswa_id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artificial Intelligence Laboratory</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <!-- kalender -->
    <link rel="stylesheet" href="assets/css/kalender.css">
</head>

<body>

    <?php include_once "sidebar.php" ?>

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>



        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Halo<?= $_SESSION['nama'] ?></h3>
                        <p class="text-subtitle text-muted">Selamat Datang di Artificial Intelligence Laboratory (Ailab)
                        </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <!-- <button class="btn btn-primary btn-sm" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Bottom popover"><i class="bi bi-bell-fill"></i></button> -->
                            <button type="button" class="btn btn-primary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Bottom popover">
                                <i class="bi bi-bell-fill"></i>
                                <span class="badge bg-danger badge-number">4</span>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total List Inventaris</h6>
                                    <h6 class="font-extrabold mb-0">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi bi-alarm-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pengingat</h6>
                                    <h6 class="font-extrabold mb-0">80.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Chart Peminjaman & Pengembalian</h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div>
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body py-1 px-1">
                            <div class="d-flex align-items-center">
                                <div class="wrapper">
                                    <header>
                                        <p class="current-date"></p>
                                        <div class="icons">
                                            <span id="prev" class="material-symbols-rounded">chevron_left</span>
                                            <span id="next" class="material-symbols-rounded">chevron_right</span>
                                        </div>
                                    </header>
                                    <div class="calendar">
                                        <ul class="weeks">
                                            <li>Mi</li>
                                            <li>Se</li>
                                            <li>Se</li>
                                            <li>Ra</li>
                                            <li>Ka</li>
                                            <li>Ju</li>
                                            <li>Sa</li>
                                        </ul>
                                        <ul class="days"></ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <?php include_once 'footer.php' ?>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- kalender -->
    <script src="assets/js/kalender.js"></script>


    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = [{
                day: 'Mon',
                chart: {
                    peminjaman: 500,
                    pengembalian: 200
                }
            },
            {
                day: 'Tue',
                chart: {
                    peminjaman: 300,
                    pengembalian: 300
                }
            },
            {
                day: 'Wed',
                chart: {
                    peminjaman: 400,
                    pengembalian: 500
                }
            },
            {
                day: 'Thu',
                chart: {
                    peminjaman: 600,
                    pengembalian: 100
                }
            },
            {
                day: 'Fri',
                chart: {
                    peminjaman: 600,
                    pengembalian: 300
                }
            },
            {
                day: 'Sat',
                chart: {
                    peminjaman: 700,
                    pengembalian: 200
                }
            },
            {
                day: 'Sun',
                chart: {
                    peminjaman: 900,
                    pengembalian: 100
                }
            }
        ];
        // setup 
        const data = {
            datasets: [{
                label: 'Peminjaman',
                data: chartData,
                backgroundColor: 'rgba(255, 26, 104, 0.2)',
                borderColor: 'rgba(255, 26, 104, 1)',
                tension: 0.4,
                parsing: {
                    xAxisKey: 'day',
                    yAxisKey: 'chart.peminjaman'
                }
            }, {
                label: 'Pengembalian',
                data: chartData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                tension: 0.4,
                parsing: {
                    xAxisKey: 'day',
                    yAxisKey: 'chart.pengembalian'
                }
            }]
        };

        // config 
        const config = {
            type: 'line',
            data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // render init block
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        // Instantly assign Chart.js version
        const chartVersion = document.getElementById('chartVersion');
        chartVersion.innerText = Chart.version;
    </script>

    <!-- popover -->
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });
        var popover = new bootstrap.Popover(document.querySelector('.example-popover'), {
            container: 'body'
        })
    </script>



</body>

</html>
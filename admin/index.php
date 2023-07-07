<?php
session_start();
if (!isset($_SESSION["teknisi_id"])) {
    header("Location: login.php");
    exit;
}
include_once "../proses/koneksi.php";
$kon = new Koneksi();

$inventaris = $kon->kueri("SELECT * FROM tb_inventaris");
$jumlahinven = $kon->jumlah_data($inventaris);

$jumlahpinjam = $kon->kueri("SELECT * FROM tb_peminjaman WHERE status = '2'");
$jumlahpinjam = $kon->jumlah_data($jumlahpinjam);

$jumlahbarang = $kon->kueri("SELECT * FROM tb_inventaris WHERE status = '0'");
$jumlahbarang = $kon->jumlah_data($jumlahbarang);

// $tanggalHariIni = date('d F Y'); // Format tanggal bulan tahun
// $tanggalHMin2 = date('d F Y', strtotime('2 days')); // Format tanggal bulan tahun

// echo $tanggalHMin2;

// Mendapatkan tanggal sekarang
$tanggalSekarang = date('d F Y');

// Mengurangi 2 hari dari tanggal sekarang
$tanggalSebelumnya = date("d F Y", strtotime("2 days", strtotime($tanggalSekarang)));

// Menghitung jumlah data dengan tanggal batas kembali yang lebih kecil dari tanggal sebelumnya
$query = "SELECT * FROM `tb_peminjaman` WHERE `tgl_batas_kembali` < '$tanggalSebelumnya' AND (status = '1' or status = '2') ";
$pengingat = $kon->kueri($query);
$jumlahpengingat = $kon->jumlah_data($pengingat);

?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "template/header.php" ?>

<body>
    <?php include_once "template/sidebar.php" ?>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Halo Admin</h3>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-md-3">
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
                                    <h6 class="font-extrabold mb-0"><?= $jumlahinven ?> Inventaris </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Peminjaman Aktif</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlahpinjam ?> Peminjam</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Barang Terpinjam</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlahbarang ?> Terpinjam</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold ">Pengingat Pengembalian</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlahpengingat ?> Mahasiswa </h6>
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
                                        <canvas id="myChart"></canvas>
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
                                <div class="wrapper col-12 col-lg-3">
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

        <?php include_once 'template/footer.php' ?>

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

</body>

</html>
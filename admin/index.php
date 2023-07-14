<?php
session_start();
if (!isset($_SESSION["teknisi_id"])) {
    header("Location: login.php");
    exit;
}
date_default_timezone_set('Asia/Jakarta');
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
                                        <center><i style="margin-top:-30px" class="bi bi-bar-chart-fill"></i></center>
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
                                        <center><i style="margin-top:-30px" class="bi bi-archive-fill"></i></center>
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
                                        <center><i style="margin-top:-30px" class="bi bi-alarm-fill"></i></center>
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
                        <div class="col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Grafik Peminjaman</h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Grafik Pengembalian</h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart1"></canvas>
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
                                <div class="wrapper container">
                                    <header>
                                        <p class="current-date"></p>
                                        <div class="icons">
                                            <span id="prev" class="material-symbols-rounded"><i class="bi bi-chevron-left"></i></span>
                                            <span id="next" class="material-symbols-rounded"><i class="bi bi-chevron-right"></i></i></span>
                                        </div>
                                    </header>
                                    <div class="calendar ">
                                        <ul class="weeks">
                                            <li>Min</li>
                                            <li>Sen</li>
                                            <li>Sel</li>
                                            <li>Rab</li>
                                            <li>Kam</li>
                                            <li>Jum</li>
                                            <li>Sab</li>
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

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            <?php
            $kueri = $kon->kueri("SELECT tgl_pinjam FROM tb_peminjaman WHERE status = '2' OR status = '4' ORDER BY tgl_pinjam ASC");
            $jumlahPeminjamanHariIni = 0;
            $tanggalHariIni = date('d-m-Y'); // Mendapatkan tanggal hari ini dalam format 'YYYY-MM-DD'
            $jumlahTglPinjam = 0; // Inisialisasi variabel untuk menyimpan jumlah $tglPinjam
            $labels = []; // Menyimpan tanggal peminjaman sebagai label
            $data = []; // Menyimpan jumlah peminjaman pada setiap tanggal
            foreach ($kueri as $item) {
                $tglPinjam = date('d-m-Y', strtotime($item['tgl_pinjam'])); // Mengubah format tanggal peminjaman dalam array menjadi 'YYYY-MM-DD'
                // Menghitung jumlah $tglPinjam
                $jumlahTglPinjam++;
                $labels[] = $tglPinjam; // Menambahkan tanggal peminjaman ke dalam array $labels
                // $data[] = $jumlahTglPinjam; // Menambahkan jumlah tanggal peminjaman ke dalam array $data
                $countData = array_count_values($labels);
                $data = [];

                foreach ($labels as $label) {
                    if (!isset($data[$label])) {
                        $data[$label] = $countData[$label];
                    }
                }
                $uniqueLabels = array_keys($data);
                $uniqueData = array_values($data);
            }


            ?>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($uniqueLabels); ?>,
                    datasets: [{
                            label: 'Peminjaman',
                            data: <?php echo json_encode($uniqueData); ?>,
                            lineTension: 0.4,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 1,
                            pointRadius: 4
                        },

                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Grafik Peminjaman'
                        }
                    }
                }
            });
        </script>


        <script>
            <?php
            $kueri = $kon->kueri("SELECT tgl_kembali FROM tb_peminjaman WHERE status = '4'");
            $jumlahPeminjamanHariIni = 0;
            $tanggalHariIni = date('d-m-Y'); // Mendapatkan tanggal hari ini dalam format 'YYYY-MM-DD'
            $jumlahTglPinjam = 0; // Inisialisasi variabel untuk menyimpan jumlah $tglPinjam
            $labels = []; // Menyimpan tanggal peminjaman sebagai label
            $data = []; // Menyimpan jumlah peminjaman pada setiap tanggal
            foreach ($kueri as $item) {
                $tglPinjam = date('d-m-Y', strtotime($item['tgl_kembali'])); // Mengubah format tanggal peminjaman dalam array menjadi 'YYYY-MM-DD'
                // Menghitung jumlah $tglPinjam
                $jumlahTglPinjam++;
                $labels[] = $tglPinjam; // Menambahkan tanggal peminjaman ke dalam array $labels
                // $data[] = $jumlahTglPinjam; // Menambahkan jumlah tanggal peminjaman ke dalam array $data
                $countData = array_count_values($labels);
                $data = [];

                foreach ($labels as $label) {
                    if (!isset($data[$label])) {
                        $data[$label] = $countData[$label];
                    }
                }
                $uniqueLabels = array_keys($data);
                $uniqueData = array_values($data);
            }


            ?>
            const ctx1 = document.getElementById('myChart1');

            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($uniqueLabels); ?>,
                    datasets: [{
                            label: 'Pengembalian',
                            data: <?php echo json_encode($uniqueData); ?>,
                            lineTension: 0.4,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 1,
                            pointRadius: 4
                        },

                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Grafik Pengembalian'
                        }
                    }
                }
            });
        </script>
        <?php include_once 'template/footer.php' ?>
</body>

</html>
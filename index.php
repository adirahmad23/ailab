<?php
session_start();
if (!isset($_SESSION["mahasiswa_id"])) {
    header("Location: login.php");
    exit;
}
include_once "proses/koneksi.php";
$kon = new Koneksi();
$user = $_SESSION['mahasiswa_id'];

$jumlahbarang = $kon->kueri("SELECT * FROM tb_inventaris");
$jumlahbarang = $kon->jumlah_data($jumlahbarang);

// $tanggalHariIni = date('d F Y'); // Format tanggal bulan tahun
// $tanggalHMin2 = date('d F Y', strtotime('2 days')); // Format tanggal bulan tahun

// echo $tanggalHMin2;

// Mendapatkan tanggal sekarang
$tanggalSekarang = date('d F Y');

// Mengurangi 2 hari dari tanggal sekarang
$tanggalSebelumnya = date("d F Y", strtotime("2 days", strtotime($tanggalSekarang)));

// Menghitung jumlah data dengan tanggal batas kembali yang lebih kecil dari tanggal sebelumnya
$query = "SELECT * FROM `tb_peminjaman` WHERE `tgl_batas_kembali` < '$tanggalSebelumnya' AND (status = '1' or status = '2') AND id_mahasiswa = '$user' ";
$pengingat = $kon->kueri($query);
$jumlahpengingat = $kon->jumlah_data($pengingat);
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
                        <h3>Halo <?= $_SESSION['nama'] ?></h3>
                        <p class="text-subtitle text-muted">Selamat Datang di Artificial Intelligence Laboratory (Ailab)
                        </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <!-- <button class="btn btn-primary btn-sm" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Bottom popover"><i class="bi bi-bell-fill"></i></button> -->
                            <button type="button" class=" btn btn-primary m-4" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="<?php
                                                                                                                                                                            $pengingatganti = $kon->kueri("SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$user'");
                                                                                                                                                                            $dataganti = $kon->hasil_data($pengingatganti);
                                                                                                                                                                            $jumlahDataTerpenuhi = 0; // Variabel untuk menyimpan jumlah data yang terpenuhi

                                                                                                                                                                            $counter = 0; // Inisialisasi variabel penampung
                                                                                                                                                                            $no = 0;

                                                                                                                                                                            if (md5($dataganti['nrp']) == $dataganti['pass']) {
                                                                                                                                                                                $counter++; // Tambah counter jika kondisi pertama terpenuhi
                                                                                                                                                                                $no++;
                                                                                                                                                                                echo $no . ". Anda belum mengganti password.
                                                                                                                                                                                            <br>";
                                                                                                                                                                            }

                                                                                                                                                                            if ($dataganti['email'] == '') {
                                                                                                                                                                                $counter++; // Tambah counter jika kondisi kedua terpenuhi
                                                                                                                                                                                $no++;
                                                                                                                                                                                echo $no . ". Anda belum mengisi email
                                                                                                                                                                            <br> ";
                                                                                                                                                                            }

                                                                                                                                                                            if ($jumlahpengingat > 0) {
                                                                                                                                                                                $counter++; // Tambah counter jika kondisi kedua terpenuhi
                                                                                                                                                                                $no++;
                                                                                                                                                                                echo $no . ". Anda memiliki peminjaman yang belum dikembalikan.
                                                                                                                                                                            <br> ";
                                                                                                                                                                            }
                                                                                                                                                                            if ($dataganti['denda'] > 0) {
                                                                                                                                                                                $counter++; // Tambah counter jika kondisi kedua terpenuhi
                                                                                                                                                                                $no++;
                                                                                                                                                                                echo $no . ". Anda memiliki denda sebesar <br> <b> Rp. " . $dataganti['denda'] . "</b>. Segera kembalikan barang yang anda pinjam.
                                                                                                                                                                            <br> ";
                                                                                                                                                                            }

                                                                                                                                                                            if ($counter > 0) {
                                                                                                                                                                            } else {
                                                                                                                                                                                echo "Tidak ada pemberitahuan";
                                                                                                                                                                            }



                                                                                                                                                                            ?>">
                                <i class="bi bi-bell-fill"></i>
                                <span class="badge bg-danger badge-number"><?= $counter ?></span>
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
                                        <center><i style="margin-top:-30px" class="bi bi-bar-chart-fill"></i></center>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total List Inventaris</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlahbarang ?> Inventaris</h6>
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
                                    <div class="stats-icon red">
                                        <center><i style="margin-top:-30px" class="bi bi-alarm-fill"></i></center>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pengingat Pengembalian</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlahpengingat ?> Pengingat</h6>
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
                                            <div class="icons">
                                                <span id="prev" class="material-symbols-rounded"><i class="bi bi-chevron-left"></i></span>
                                                <span id="next" class="material-symbols-rounded"><i class="bi bi-chevron-right"></i></i></span>
                                            </div>
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

        <?php include_once 'footer.php' ?>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <!-- <script src="assets/js/app.js"></script> -->
    <!-- kalender -->
    <script src="assets/js/kalender.js"></script>


    <!-- Need: Apexcharts -->
    <!-- <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script> -->



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        $kueri = $kon->kueri("SELECT tgl_kembali FROM tb_peminjaman WHERE status = '4' order by tgl_kembali asc");
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


    <!-- popover -->
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl, {
                html: true
            })

        });
        var popover = new bootstrap.Popover(document.querySelector('.example-popover'), {
            container: 'body'

        })
    </script>



</body>

</html>